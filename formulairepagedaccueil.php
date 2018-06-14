<html>
<body style="background-color: aliceblue">
<style>
    #login{
        background-color: white;
        height:30%;
        margin:20px;
</style>
 
<center>
        <h1 style='font-family: "Comic Sans MS", Sans-Serif; color: #FF8000; font-size: 38px;'>LOGIN</h1>
        
        
<?php
    if ($_POST['type'] == 'nounou'){
        $action= 'traitementloginnounou.php';
    }
    elseif ($_POST['type'] == 'parent') {
        $action = 'traitementloginparents.php';
    
    }
    else {
        $action = 'traitementloginadministrateur.php';
    }
        ?>
        
    <div id="login">
        
<?php

        echo '<form method="post" action="' . $action . '">';
                
?>                
            <label> Nom de Login</label>
            <br/>
            <input type="text" name="login" style=" background-color: #FFFFFF;
        border-right-style: solid;
        border-bottom-color: #0CD2E8;
        border-left-style: solid;
        border-left-color: #0CD2E8;
        border-top-color: #0CD2E8;
        border-bottom-style: solid;
        border-right-color: #0CD2E8;
        border-top-style: solid;
        font-size: 28px;
        line-height:30px ;
        margin-left: 10px;
    ">
            <br/>
            </br>
            <label> Mot de Passe</label>
            </br>
            <input type="password" name="passwd" style=" background-color: #FFFFFF;border-right-style: solid; border-right-style: solid;
        border-bottom-color: #0CD2E8;
        border-left-style: solid;
        border-left-color: #0CD2E8;
        border-top-color: #0CD2E8;
        border-bottom-style: solid;
        border-right-color: #0CD2E8;
        border-top-style: solid;
        font-size: 28px;
        line-height:30px ;
        margin-left: 10px;
    ">
            <br/><br/>
                <input type="submit" name="submit" style="font-size: 30px">
 
        </form>

    </div>
</center>
</body>
    </html>
