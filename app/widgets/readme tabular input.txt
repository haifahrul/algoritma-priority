class Order extends ActiveRecord
{
    use \mdm\behavior\ar\RelationTrait;

   ....
    public function getItems()
    {
        return $this->hasMany(Item::className(),['order_id'=>'id']);
    }
    public function setItems($value)
    {
        $this->loadRelated('items', $value);
    }
}
=====================
Note jika error not found train bisa menggunakan
class Order extends ActiveRecord
{
    public function getItems()
    {
        return $this->hasMany(Item::className(),['order_id'=>'id']);
    }
    public function behaviors()
    {
      return [
            [
                'class' => 'mdm\behaviors\ar\RelationBehavior',
                //'beforeRSave' => function($item){
                  //  return $item->qty != 0;
                //}
            ],
        ];
    }
} 



di contorollernya 
$model = new Order();
if($model->load(Yii::$app->request->post()){
    $model->items = Yii::$app->request->post('Item',[]);
    $model->save();
}
=================

class Item extends ActiveRecord
{
    ...
    public function getOrder()
    {
        return $this->hasOne(Order::className(),['id'=>'order_id']);
    }
}


<?= 
    TabularInput::widget([
        'id' => 'detail-grid',
        'allModels' => $model->items,
        'modelClass' => OrderItem::className(),
        'options' => ['tag' => 'tbody'],
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_detail',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add',
        ]
    ]);
?>

</table>