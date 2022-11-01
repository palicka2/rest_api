<?php

//curl localhost/?name=1
//curl -d "name=xxx" -X POST localhost
//curl -X DELETE localhost/?person=3
//curl -d "user=xxx&index=1 -X PUT localhost

class Person{
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){

    if($_GET["person"]){
        $file = fopen("names.json", "r") or die("file cannot be opened");
        $json = fread($file, filesize("names.json"));
        fclose($file);
        $output = json_decode($json);
        if($output[$_GET["person"]]->name) {
            print($output[$_GET["person"]]->name);
        }
    }
    else{
        print($output);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if($_POST["name"]){
        $data = $_POST["name"];
        $output = [];
        $file = fopen("names.json", "r") or die("file cannot be opened");
        $json = fread($file, filesize("names.json"));
        fclose($file);
        $output = json_decode($json);
        $person = new Person();
        $person->name = $data;
        array_push($output, $person); 
        $json = json_encode($output);
        file_put_contents("names.json", $json);
    }
    else{
        print("cannot insert");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE"){
    if($_GET["person"]){
        $file = fopen("names.json", "r") or die("file cannot be opened");
        $json = fread($file, filesize("names.json"));
        fclose($file);
        $output = json_decode($json);
        array_splice($output, $_GET["person"], 1);
        $json = json_encode($output);
        file_put_contents("names.json", $json);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "PUT"){

}

else{

    print(". . . . Unable to GET/POST/DELETE/PUT");

}


?>