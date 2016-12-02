Exporting Data

Exporting data into an excel file.
<?php
// export data only one worksheet.
app\widgets\ExportExcel::widget([
    'models' => $allModels,
    'mode' => 'export', //default value as 'export'
    'columns' => ['column1','column2','column3'], //without header working, because the header will be get label from attribute label. 
    'header' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'], 
]);

app\widgets\ExportExcel::export([
    'models' => $allModels, 
    'columns' => ['column1','column2','column3'], //without header working, because the header will be get label from attribute label. 
    'header' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
]);

// export data with multiple worksheet.
app\widgets\ExportExcel::widget([
    'isMultipleSheet' => true, 
    'models' => [
        'sheet1' => $allModels1, 
        'sheet2' => $allModels2, 
        'sheet3' => $allModels3
    ], 
    'mode' => 'export', //default value as 'export' 
    'columns' => [
        'sheet1' => ['column1','column2','column3'], 
        'sheet2' => ['column1','column2','column3'], 
        'sheet3' => ['column1','column2','column3']
    ],
    //without header working, because the header will be get label from attribute label. 
    'header' => [
        'sheet1' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'], 
        'sheet2' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'], 
        'sheet3' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3']
    ],
]);



app\widgets\ExportExcel::export([
    'isMultipleSheet' => true, 
    'models' => [
        'sheet1' => $allModels1, 
        'sheet2' => $allModels2, 
        'sheet3' => $allModels3
    ], 'columns' => [
        'sheet1' => ['column1','column2','column3'], 
        'sheet2' => ['column1','column2','column3'], 
        'sheet3' => ['column1','column2','column3']

    ], 

    //without header working, because the header will be get label from attribute label. 
    'header' => [
        'sheet1' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
        'sheet2' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
        'sheet3' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3']
    ],

]);