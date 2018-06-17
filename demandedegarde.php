<?php
require_once 'database1.php';
session_start();
$num=$_SESSION['num'];
$lirenumdenfants = $basedd->prepare("SELECT * FROM Enfants where parent = ?");
    $lirenumdenfants->bindParam(1, $num);
    $lirenumdenfants->execute();



?>
<!DOCTYPE html>
<html>
<head>
    <style>
 
        p{
            color:dodgerblue;
            text-align: center;
            font-size: 50px;
            margin-top: 30px;
            background-color: orange;
        }
 
    </style>
    <title></title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="./bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 
 
</head>
 
<body style="background-color: aliceblue">
<div class="container" >
    <form method="post" action="traitementnounouponctuelle.php" class="form-horizontal">
        <fieldset style="background-color: white " >
            <legend>Demande de garde <br/></legend>
 
 
<!--            <div class="control-group">
                <label class="control-label">Type</label>
                <div class="controls input-append " >
                    <select name="type" id="type">
                        <option value="2">regulièrement</option>
                        <option value="1">ponctuellement</option>
 
                    </select>
                </div>
            </div>-->
 
 
            <div class="control-group">
                <label class="control-label">Jour de Début</label>
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" name="JD" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
 
            <div class="control-group">
                <label class="control-label">Jour de Fin</label>
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" name="JF" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
 
            <div class="control-group">
                <label class="control-label">Heure de Début</label>
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input size="16" type="text" name="HD" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </div>
 
 
            <div class="control-group">
                <label class="control-label">Heure de Fin</label>
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input size="16" type="text" name="HF" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input3" value="" /><br/>
            </div>
 
 
 
 
 
 
<!--            <div class="control-group" id="hide">
                <label class="control-label">Récurrence</label>
                <div class="controls input-append " >
                    <select name="recurrence" id="recurrence">
 
                        <option>tous les jours travaillés</option>
                        <option>tous les jours</option>
                        <option>tous les lundis</option>
                        <option>tous les mardis</option>
                        <option>tous les mercredis</option>
                        <option>tous les jeudis</option>
                        <option>tous les vendredis</option>
                        <option>tous les samedis</option>
                        <option>tous les dimanches</option>
                    </select>
                </div>
            </div>-->
 
            <div class="control-group " >
                <label class="control-label">Je veux que ma nounou parle une autre langue que le français</label>
                <div class="controls input-append " >
                <input size="16" type="checkbox" id="langue" name="langue" value="1" onclick="chk(this)">
                </div>
 
            </div>
 
            <div class="control-group" id="hide1" >
                <label class="control-label">Langues parlées</label>
                <div class="controls input-append " >
<?php
$langues = array ('français', 'anglais', 'chinois', 'espagnol', 'italien', 'portugais', 'hindi', 'arabe', 'allemand', 'russe', 'hongrois'); 
foreach ($langues as $lang){
    echo '<input type="radio" name="languechoisie" id="languechoisie" value="' . $lang . '"><label for="' . $lang . '">' . $lang . '</label>';
}
?>
                    
                </div>
            </div>
            
            <div class="field">
                <label>Quels enfants voulez-vous garder ?</label><br>
            <?php
while ($donnes1 = $lirenumdenfants->fetch()){
    $numenfant = $donnes1["numero d'enfants"];
    $prenomenfant = $donnes1['prenom'];
            
echo '<input type="checkbox" name="' . $numenfant . '"/><label for="' . $numenfant . '">' . $prenomenfant . '</label>';

    }        
   
            ?>
            
            </div>
            <center>
                <input type="submit" name="submit" value="ok" style="font-size: 15px">
            </center>
 
 
 
 
        </fieldset>
    </form>
</div>
 
<script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="./bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>
 
<script>
    function chk(obj){
        if(obj.checked){
            $("#hide1").show();
        }else{
            $("#hide1").hide();
        }
    }
</script>
<script>
window.onload = function(){
var obj_select = document.getElementById("type");
var obj_div = document.getElementById("hide");
obj_select.onchange = function(){
obj_div.style.display = this.value==2? "block" : "none";
}
}
</script>
</body>
</html>
