<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contacts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'surname',
            'email:email',
            'datebirth',
            [
                'label' => 'Телефоны',
                'attribute' => 'telContacts',
                'format' => 'text',
                'value' => 'telephonesContacts',
                
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<?  
 
$map[10][10];

echo '<table border="1" style="float: left;">';
for($u1 = 1; $u1 <= 10; $u1++) {
    echo "<tr>";
    for($u2 = 1; $u2 <= 10; $u2++) {
        $val = round(rand(0,10));
        if($val < 2) {
            $map[$u1][$u2] = 1;
            echo "<td style=\"width:50px; height: 50px; background-color: #0f0\"></td>";
        } else {
            $map[$u1][$u2] = 0;
            echo "<td style=\"width:50px; height: 50px; \"></td>";
        }
    }
    echo "</tr>";
}
echo "<table>";


function map($x, $y, $x1, $y1, $map)
{
    $size = 10;
    $matrix[$size][$size][3];

    $step;
    $added = true;
    $result = true;

    $map[$x][$y] = 0;
    $map[$x1][$y1] = 0;
    
    for($i = 0; $i < $size; $i++) {
        for($j = 0; $j < $size; $j++) {
            if($map[$i][$j]!= 0){
                $matrix[$i][$j][0] = -2;
            } else {
                $matrix[$i][$j][0] = -1;
            }
        }
    }
    
    $matrix[$x1][$y1][0] = 0;
    $step = 0; 
   
    while($added && $matrix[$x][$y][0] == -1) {
        $added = false;
        $step++;

        for($i=0; $i < $size; $i++) {
            for($j=0; $j < $size; $j++) {
                if($matrix[$i][$j][0] == $step-1) {
                    
                    $i2 = $i+1;
                    $j2 = $j;  
                    if($i2 >= 0 && $j2 >= 0 && $i2 < $size && $j2 < $size) {
                        if($matrix[$i2][$j2][0] == -1 && $matrix[$i2][$j2][0] != -2) {
                             $matrix[$i2][$j2][0]= $step; 
                             $matrix[$i2][$j2][1]= $i; 
                             $matrix[$i2][$j2][2]= $j; 
                             $added = true; 
                         }
                    }

                    $i2 = $i-1;
                    $j2 = $j;
                    if($i2 >= 0 && $j2 >= 0 && $i2 < $size && $j2 < $size) {
                        if($matrix[$i2][$j2][0] == -1 && $matrix[$i2][$j2][0] != -2) {
                             $matrix[$i2][$j2][0]= $step; 
                             $matrix[$i2][$j2][1]= $i; 
                             $matrix[$i2][$j2][2]= $j; 
                             $added = true; 
                         }
                    }

                    $i2 = $i;
                    $j2 = $j+1;
                    if($i2 >= 0 && $j2 >= 0 && $i2 < $size && $j2 < $size) {
                        if($matrix[$i2][$j2][0] == -1 && $matrix[$i2][$j2][0] != -2) {
                             $matrix[$i2][$j2][0]= $step; 
                             $matrix[$i2][$j2][1]= $i; 
                             $matrix[$i2][$j2][2]= $j; 
                             $added = true; 
                         }
                    }

                    $i2 = $i;
                    $j2 = $j-1;
                    if($i2 >= 0 && $j2 >= 0 && $i2 < $size && $j2 < $size) {
                        if($matrix[$i2][$j2][0] == -1 && $matrix[$i2][$j2][0] != -2) {
                             $matrix[$i2][$j2][0]= $step; 
                             $matrix[$i2][$j2][1]= $i; 
                             $matrix[$i2][$j2][2]= $j; 
                             $added = true; 
                         }
                    }
                }
            }
        }
    }

    if($matrix[$x][$y][0] == -1) {
        $result = false; 
    }

    if($result) {
        $i2 = $x;
        $j2 = $y;
        $map[$x][$y] = 2;
        while($matrix[$i2][$j2][0] != 0) {   
            $li = $matrix[$i2][$j2][1];
            $lj = $matrix[$i2][$j2][2];
            $i2 = $li;
            $j2 = $lj;
            $map[$i2][$j2] = 2;
        }
    }  
    return $map;
} 

$map2 = map(1, 5, 9, 2, $map);

echo '<table border="1" style="float: right;">';
for($u1 = 1; $u1 <= 10; $u1++) {
    echo "<tr>";
    for($u2 = 1; $u2 <= 10; $u2++) {
        if($map2[$u1][$u2] == 1) echo "<td style=\"width:50px; height: 50px; background-color: #0f0\"></td>";
        if($map2[$u1][$u2] == 0) echo "<td style=\"width:50px; height: 50px;\"></td>";
        if($map2[$u1][$u2] == 2) echo "<td style=\"width:50px; height: 50px; background-color: #00f\"></td>";

    }
    echo "</tr>";
}
echo "</table>";

?>