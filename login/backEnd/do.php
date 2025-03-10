<?php
// backEnd/do.php

// Incluir el archivo de configuración y seguridad
include("appHeader.php");

// Configurar el tipo de contenido como texto plano para salida en tiempo real
header('Content-Type: text/plain');
header('Cache-Control: no-cache'); // Evitar que el navegador almacene en caché

// Función para enviar mensajes al cliente en tiempo real
function sendMessage($message) {
    echo $message . "\n";
    ob_flush(); // Enviar el búfer de salida al cliente
    flush();    // Forzar la salida al navegador
}

// Función para actualizar un archivo YAML
function updateYamlFile($filePath, $newValues) {
    $yamlContent = file_get_contents($filePath); // Leer el contenido del archivo
    foreach ($newValues as $key => $value) {
        // Reemplazar valores en el archivo YAML
        $yamlContent = preg_replace("/$key:.*/", "$key: \"$value\"", $yamlContent);
    }
    file_put_contents($filePath, $yamlContent); // Guardar los cambios
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $ftp_user = $_POST['ftp_user'];
    $ftp_pass = $_POST['ftp_pass'];
    $mysql_root = $_POST['mysql_root'];

    // Actualizar el archivo vars.yml con los valores del formulario
    $varsFilePath = "../ansible/vars/vars.yml";
    $newValues = [
        'wpDomain' => $_POST['lamp_domain'] ?? $_POST['wordpress_domain'] ?? '',
        'wpDBUser' => $_POST['lamp_db_user'] ?? $_POST['wordpress_db_user'] ?? '',
        'wpDBPassword' => $_POST['lamp_db_pass'] ?? $_POST['wordpress_db_pass'] ?? '',
        'nxDomain' => $_POST['nextcloud_domain'] ?? '',
        'nxDBUser' => $_POST['nextcloud_db_user'] ?? '',
        'nxDBPassword' => $_POST['nextcloud_db_pass'] ?? '',
        'moodleDomain' => $_POST['moodle_domain'] ?? '',
        'moodleDBUser' => $_POST['moodle_db_user'] ?? '',
        'moodleDBPassword' => $_POST['moodle_db_pass'] ?? '',
        'mysqlRootPassword' => $mysql_root,
    ];
    updateYamlFile($varsFilePath, $newValues);








    $file = "../ansible/vars/vars.yml";
    $content = file_get_contents($file);
  
    // Expresiones regulares para reemplazar valores
    $ftp_user = $_POST['ftp_user'];
    $ftp_pass = $_POST['ftp_pass'];
    $mysql_root = $_POST['mysql_root'];
    $wpDomain = $_POST['wordpress_domain'];
    $wpDBUser = $_POST['wordpress_db_user'];
    $wpDBPassword = $_POST['wordpress_db_pass'];
    $nxDomain = $_POST['nextcloud_domain'];
    $nxDBUser = $_POST['nextcloud_db_user'];
    $nxDBPassword = $_POST['nextcloud_db_user'];
    $moodleDomain = $_POST['moodle_domain'];
    $moodleDBUser = $_POST['moodle_db_user'];
    $moodleDBPassword = $_POST['moodle_db_pass'];


    $content = preg_replace('/mysqlRootPassword:\s*"(.*)"/','mysqlRootPassword: "'.$mysql_root.'"',$content);
    $content = preg_replace('/wpDomain:\s*"(.*)"/','wpDomain: "'.$wpDomain.'"',$content);
    $content = preg_replace('/wpDBUser:\s*"(.*)"/','wpDBUser: "'.$wpDBUser.'"',$content);
    $content = preg_replace('/wpDBPassword:\s*"(.*)"/','wpDBPassword: "'.$wpDBPassword.'"',$content);
    $content = preg_replace('/nxDomain:\s*"(.*)"/','nxDomain: "'.$nxDomain.'"',$content);
    $content = preg_replace('/nxDBUser:\s*"(.*)"/','nxDBUser: "'.$nxDBUser.'"',$content);
    $content = preg_replace('/nxDBPassword:\s*"(.*)"/','nxDBPassword: "'.$nxDBPassword.'"',$content);
    $content = preg_replace('/moodleDomain:\s*"(.*)"/','moodleDomain: "'.$moodleDomain.'"',$content);
    $content = preg_replace('/moodleDBUser:\s*"(.*)"/','moodleDBUser: "'.$moodleDBUser.'"',$content);
    $content = preg_replace('/moodleDBPassword:\s*"(.*)"/','moodleDBPassword: "'.$moodleDBPassword.'"',$content);
    
    file_put_contents($file, $content);

    echo $content;
}


    // Inicializar un array para almacenar los comandos de Ansible
    $commands = [];

    // Verificar qué aplicaciones se seleccionaron
    if (isset($_POST['lamp_domain']) || isset($_POST['wordpress_domain'])) {
        $commands[] = "ansible-playbook -i ../ansible/inventario ../ansible/menu.yml  --extra-vars 'action=0'";
    }
    if (isset($_POST['nextcloud_domain'])) {
        $commands[] = "ansible-playbook -i ../ansible/inventario ../ansible/menu.yml --extra-vars 'action=1'";
    }
    if (isset($_POST['moodle_domain'])) {
        $commands[] = "ansible-playbook -i ../ansible/inventario ../ansible/menu.yml --extra-vars 'action=3'";
    }

    // Ejecutar los comandos de Ansible
    if (!empty($commands)) {
        sendMessage("Iniciando la instalación...");

        foreach ($commands as $command) {
            sendMessage("Ejecutando comando: $command");

            // Ejecutar el comando y capturar la salida en tiempo real
            $handle = popen($command . ' 2>&1', 'r');
            if ($handle) {
                while (!feof($handle)) {
                    $output = fgets($handle);
                    sendMessage($output); // Enviar la salida al cliente
                }
                pclose($handle);
            } else {
                sendMessage("Error al ejecutar el comando: $command");
            }
        }

        sendMessage("Instalación completada.");
    } else {
        sendMessage("Error: No se seleccionó ninguna aplicación.");
    }

?>