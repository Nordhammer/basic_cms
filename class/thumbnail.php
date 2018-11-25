<?php

/*
 * The MIT License
 *
 * Copyright 2016 Vlat Dracul <vlat_dracul at hotmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of thumbnail
 *
 * @author Vlat Dracul <vlat_dracul at hotmail.com>
 */
class thumbnail {

    //put your code here
    static $imgPath = null;
    static $thumbPath = null;

static private function generate($type,$path, $filename, $height = null, $width = null, $quality = 100, $filetype = 'jpg') {
    $ImageData = \getimagesize($path);

        $orginalWidth = $ImageData[0];
        $orginalHeight = $ImageData[1];
        $orginalFiletype = $ImageData['mime'];
        if ($width === null) {
            $width = $orginalWidth * ($height / $orginalHeight);
        }
        if ($height == null) {
            $height = $orginalHeight * ($width / $orginalWidth);
        }

        $_img = \imagecreatetruecolor($width, $height);
        if ($orginalFiletype == 'image/jpeg') {
            $img = \imagecreatefromjpeg($path);
        }
        if ($orginalFiletype == 'image/gif') {
            $img = \imagecreatefromgif($path);
        }
        if ($orginalFiletype == 'image/png') {
            $img = \imagecreatefrompng($path);
        }
        \imagecopyresampled($_img, $img, 0, 0, 0, 0, $width, $height, $orginalWidth, $orginalHeight);
        if ($filetype == 'jpg') {
            \imagejpeg($_img, $type . $filename . '.jpg', $quality);
        }
        if ($filetype == 'png') {
            $png_quality = ceil(($quality/10)-1);
            if($png_quality < 0)  $png_quality =0;
            \imagepng($_img, $type . $filename . '.png', $png_quality);
        }
        if ($filetype == 'gif') {
            \imagegif($_img, $type . $filename . '.gif');
        }
        \imagedestroy($_img);

}

    static public function generateImage($path, $filename, $height = null, $width = null, $quality = 85, $filetype = 'jpg') {
        self::generate(self::$imgPath, $path, $filename, $height, $width, $quality, $filetype);

    }

    static public function generateThumb($path, $filename, $height = null, $width = null, $quality = 85, $filetype = 'jpg') {
        self::generate(self::$thumbPath, $path, $filename, $height, $width, $quality, $filetype);
    }

    static public function deleteImg($path,$filename) {
      $filename = basename($filename);
      echo $path.$filename;
      if (file_exists($path.$filename)) { // prüft ob existiert
        if (is_writable($path.$filename)) { // prüft ob beschreibbar
          unlink($path.$filename); // löscht das poster
          unlink($path.'thumbs/'.$filename); // löscht das thumbnail
        } else {
          echo 'Error: Konnte die Datei nicht löschen.';
        }
      } else {
        echo 'Error: Die Datei existiert nicht.';
      }

    }

    // PRÜFT OB EINE GRAFIK IN DER DB GESPEICHERT IST UND GIBT WENN NICHT EIN ERSATZBILD AUS
    // Thumbnail::noImage($row['image'],"avatar");
    static public function noImage($image,$phrase) {
      if (!empty($image)) {
          return $image;
      } else {
        // keine datei => ersetzen durch platzhalter
        switch ($phrase) {
          case 'avatar':
          $img = 'Avatar';
          break;
          case 'poster':
          $img = 'Poster';
          break;
          case 'person':
            $img = 'Person';
          default:
          break;
        }
        // ausgeben platzhalter
        return $image = 'no'.$img.'.png';
      }
    }

}

/** Anwendungsbeispiel
 *
 * thumbnail::$imgPath = dirname(__FILE__).'/_userfiles/images/'; //definiere Ordner für großes Bild
 * thumbnail::$thumbPath = dirname(__FILE__).'/_userfiles/thumbs/'; //definiere Ordner für kleines Bild
 * thumbnail::generateImage('http://www.yourmdb.de/img/poster/392_und_dann_kam_polly_2004.jpg', 'Dateiname', 1024);
 * thumbnail::generateThumb('http://www.yourmdb.de/img/poster/392_und_dann_kam_polly_2004.jpg', 'Dateiname', 200);
 *
 * Parameter
 * 1 = Pfad des Orginals
 * 2 = Dateiname wie es heißen soll, ohne Dateiendung
 * 3 = Höhe, vorgabewert ist null
 * 4 = Breite, vorgabewert ist null
 * 5 = Qualität, vorgabewert ist 85
 * 6 = Dateiendung des Zielbildes, gif,jpg oder png*
 *
 *
 * Wenn Höhe die Vorgabe ist, wird die Breite mit null angegeben. Somit berechnet das Script die Breite.
 * Wenn Breite die Vorgabe ist, wird die Höhe mit null angegeben. Somit wird die Höhe errechnet.
 */
