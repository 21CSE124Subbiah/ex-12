<?php

$xml = simplexml_load_file("books.xml");

if (isset($_GET["book"])) {
    $book = $_GET["book"];
   
    $result = $xml->xpath("//book[title='$book']");
    if (count($result) > 0) {
       
        $book = $result[0];
        $response = "<book>"
            . "<title>" . $book->title . "</title>"
            . "<author>" . $book->author . "</author>"
            . "<year>" . $book->year . "</year>"
            . "<genre>" . $book->genre . "</genre>"
            . "<publisher>" . $book->publisher . "</publisher>"
            . "<price>" . $book->price . "</price>"
            . "</book>";
        header("Content-type: text/xml");
        echo $response;
    }
    else {
   
        header("HTTP/1.1 404 Not Found");
        echo "Book not found";
    }
}
else {
  
    $response = "<books>";
    foreach ($xml->book as $book) {
        $response .= "<title>" . $book->title . "</title>";
    }
    $response .= "</books>";
    header("Content-type: text/xml");
    echo $response;
}
?>
