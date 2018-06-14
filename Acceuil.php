<html>
<title> Chercher Nounous</title>
 
<style>
    .left{
        background-color: orange;
        float:left;
        width:55%;
        height:100%;
    }
 
 
    .right{
        background-color: aliceblue;
        float:right;
        width:44%;
        height:100%;
    }
    #login{
    background-color: white;
    height:30%;
    margin:20px;
 
 
}
    #inscription{
        background-color: white;
        height:10%;
        margin:20px
 
 
    }
 
    /*input{
        background-color: #FFFFFF;
        border-right-style: dashed;
        border-bottom-color: #00FFFF;
        border-left-style: dashed;
        border-left-color: #00FFFF;
        border-top-color: #00FFFF;
        border-bottom-style: dashed;
        border-right-color: #00FFFF;
        border-top-style: dashed;
        font-size: 28px;
        line-height:30px ;
        margin-left: 10px;
    }*/
 
</style>
 
 
<div class="left">
    <center>
        <h1 style="font-family: Tahoma, Verdana, Arial, Sans-Serif; color: white; font-size: 25px; left: 30px"> Qui veut jouer avec moi?</h1>
    <image src="image/baby3.tiff" width="500px" style="margin-top:100px"></image>
    </center>
</div>
 
 
 
<div class="right"><center>
    <h1 style='font-family: "Comic Sans MS", Sans-Serif; color: #FF8000; font-size: 38px;'>choisissez votre compte</h1>
    </center>
    <div id="login">
        <form method="post" action="formulairepagedaccueil.php">
            <input type="hidden" name="type" value="nounou">
        </br>
            <label> <b>Nounou</b></label>
 
        <input type="submit"  style=" background-color: #FFFFFF;
        border-right-style: solid;
        border-bottom-color: #0CD2E8;
        border-left-style: solid;
        border-left-color: #0CD2E8;
        border-top-color: #0CD2E8;
        border-bottom-style: solid;
        border-right-color: #0CD2E8;
        border-top-style: solid;
        font-size: 20px;
        line-height:30px ;
        margin-left: 10px;
    ">
        </form>
        <hr>
        <form method="post" action="formulairepagedaccueil.php">
            <input type="hidden" name="type" value="parent">
            <label><b> Parent</b></label>
 
        <input type="submit"  style=" background-color: #FFFFFF;border-right-style: solid; border-right-style: solid;
        border-bottom-color: #0CD2E8;
        border-left-style: solid;
        border-left-color: #0CD2E8;
        border-top-color: #0CD2E8;
        border-bottom-style: solid;
        border-right-color: #0CD2E8;
        border-top-style: solid;
        font-size: 20px;
        line-height:30px ;
        margin-left: 10px;
    ">
        </form>
            <hr>
        <form method="post" action="formulairepagedaccueil.php">
            <input type="hidden" name="type" value="administrateur">
            <label> <b>Administrateur</b></label>
            <input type="submit"  style=" background-color: #FFFFFF;border-right-style: solid; border-right-style: solid;
        border-bottom-color: #0CD2E8;
        border-left-style: solid;
        border-left-color: #0CD2E8;
        border-top-color: #0CD2E8;
        border-bottom-style: solid;
        border-right-color: #0CD2E8;
        border-top-style: solid;
        font-size: 20px;
        line-height:30px ;
        margin-left: 10px;
    ">
        </form>
 
    <br/>
    <center>
        <p style='font-family: "Comic Sans MS", Sans-Serif; color: #FF8000; font-size: 30px;'>INSCRIPTION</p>
    </center>
    <div id="inscription"><br/>
 
        <label>Vous êtes Nounou</label>
        <a href="formulaireinscriptionnounou.php">cliquer ici</a>
        <br/>
        <label>Vous êtes Parents</label>
        <a href="formulaire%20d%20inscription%20des%20parents.php">cliquer ici</a>
    </div>
 
</div>
 
 
</html>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
</html>