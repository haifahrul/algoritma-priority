<?php

/**
 * Created by PhpStorm.
 * User: dzas
 * Date: 6/27/2016
 * Time: 9:47 AM
 */
class GlobalFunction
{
    public function sendEmail($layout, $from, $to, $subject)
    {
        Yii::$app
            ->mailer
            ->compose(
                ['html' => $layout],
                ['user' => $from]
            )
            ->setFrom([$from => Yii::$app->name . ' robot'])
            ->setTo($to)
            ->setSubject($subject)
            ->send();
    }

    public function ejaBilangan($n)
    {
        $dasar = array(1 => 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
        $angka = array(1000000000, 1000000, 1000, 100, 10, 1);
        $satuan = array('Milyar', 'Juta', 'Ribu', 'Ratus', 'Puluh', '');
        $i = 0;
        $str = "";
        while ($n != 0) {
            $count = (int)($n / $angka[$i]);
            if ($count >= 10) $str .= $this->eja($count) . " " . $satuan[$i] . " ";
            else if ($count > 0 && $count < 10)
                $str .= $dasar[$count] . " " . $satuan[$i] . " ";
            $n -= $angka[$i] * $count;
            $i++;
        }
        $str = preg_replace("/satu puluh (\w+)/i", "\\1 belas", $str);
        $str = preg_replace("/satu (ribu|ratus|puluh|belas)/i", "Se\\1", $str);
        return $str . ' Rupiah';
    }
}