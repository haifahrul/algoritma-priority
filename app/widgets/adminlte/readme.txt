contoh menggunakan nya 
infobox untuk informasi angka atau bar
use app\widgets\adminlte\Infobox;
    <?php 
                    echo Infobox::widget([
                            'infoText'=>'Status Open',
                            'infoNumber'=>13,
                            'type'=>InfoBox::TYPE_GREEN,
                            'progress'=>100,
                            'progressDescription'=>'Status Delevery Orders'

                        ]);
                    ?> 
                


box untuk collapse
<?php
                    Box::begin([
                    'title'=>'SYSTEM',
                    'type'=>BOX::PRIMARY,
                    'typeButton'=> 'both',
                    'footer'=> 'dzas'
                    ]);
                ?>
                    konten
                <?php Box::end(); ?>


membuat panel 
 <?php
                    Panel::begin([
                    'title'=>'SYSTEM',
                    'type'=>Panel::TYPE_SUCCESS
                    ]);
                ?>
 kontem 
                <?php Panel::end(); ?>
