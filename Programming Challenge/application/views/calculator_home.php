<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to my calculator CodeIgniter challenge!</title>

    <style type="text/css">

        ::selection{ background-color: #E13300; color: white; }
        ::moz-selection{ background-color: #E13300; color: white; }
        ::webkit-selection{ background-color: #E13300; color: white; }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body{
            margin: 0 15px 0 15px;
        }
        
        p.footer{
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container{
            margin: 10px;
            border: 1px solid #D0D0D0;
            -webkit-box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>
<body>

    <div id="container">
        <h1>Welcome to my calculator CodeIgniter challenge!</h1>

        <div id="body">
            <h2>Enter two numbers and select an operator!</h2>
            <?php 
            echo validation_errors();
            echo form_open(); 
            ?>
            <input type="text" name="number1" value="<?php echo set_value('number1'); ?>"/>
<?php
if (isset($operatorSelected)) {
    echo form_dropdown('operator', $options, $operatorSelected);
} else {
    echo form_dropdown('operator', $options);
}
?>
            <input type="text" name="number2" value="<?php echo set_value('number2'); ?>"/>
            <input type="submit" value="Do Math!" />
            
<?php
if (isset($answer)) {
    ?><h2>Your answer is <?php echo $answer; ?></h2><?php
}
?>
            <br /><br /><br />
            <h2>Here is a different way to do it! Enter your mathmatical equation below</h2>
            <input type="text" name="dirtyinput" />
            <input type="submit" value="Do Different Math!" />
<?php
if (isset($answerTwo) && is_null($error)) {
    ?><h2>Your answer is <?php echo $answerTwo; ?></h2><?php
} else if (isset($error)) {
    ?><h2>An error occured <?php echo $error; ?></h2><?php
}
?>
        </form>
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>