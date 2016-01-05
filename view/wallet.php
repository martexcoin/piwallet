<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php
if (!empty($error))
{
    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
}
?>
<p>Ol&aacute;, <strong><?php echo $user_session; ?></strong>! <?php if ($admin) {?><strong><font color="red">[Admin]</font><?php }?></strong></p>
<p>Saldo: <strong id="balance"><?php echo satoshitize($balance); ?></strong> <?=$short?></p>

<form action="index.php" method="POST">

<?php
if ($admin)
{
  ?>
<h4>Admin Links:</h4>
  <a href="?a=home" class="btn btn-default">Admin Dashboard</a>
<h4>Links:</h4>
  <?php
}
?>
<form>
        <input type="hidden" name="action" value="logout" />
        <button type="submit" class="btn btn-default">Sair</button>
</form>
<form action="index.php" method="POST">
<input type="hidden" name="action" value="support" action="index.php"/>
<button type="submit" class="btn btn-default">Suporte</button>
</form>

<form action="index.php" method="POST">
<form>
<input type="hidden" name="action" value="authgen" />
<button type="submit" class="btn btn-default">Ativar 2 Factor Auth</button>
</form><p>
<form action="index.php" method="post">
<form>
<input type="hidden" name="action" value="disauth" />
<button type="submit" class="btn btn-default">Desativar 2 Factor Auth</button>
</form>

<br>

<br />
<p>Atualizar sua senha:</p>
<form action="index.php" method="POST" class="clearfix" id="pwdform">
    <input type="hidden" name="action" value="password" />
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <div class="col-md-2"><input type="password" class="form-control" name="oldpassword" placeholder="Senha atual"></div>
    <div class="col-md-2"><input type="password" class="form-control" name="newpassword" placeholder="Nova senha"></div>
    <div class="col-md-2"><input type="password" class="form-control" name="confirmpassword" placeholder="Confirmar nova senha"></div>
    <div class="col-md-2"><button type="submit" class="btn btn-default">Atualizar</button></div>
</form>
<p id="pwdmsg"></p>
<br />
<p>Sacar:</p>
<button type="button" class="btn btn-default" id="donate">Doe!</button><br><br>
<p id="donateinfo" style="display: none;">Insira o valor que deseja doar e clique em  <strong>Sacar</strong></p>
<form action="index.php" method="POST" class="clearfix" id="withdrawform">
    <input type="hidden" name="action" value="withdraw" />
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <div class="col-md-4"><input type="text" class="form-control" name="address" placeholder="Endere&ccedil;o"></div>
    <div class="col-md-2"><input type="text" class="form-control" name="amount" placeholder="Valor"></div>
    <div class="col-md-2"><button type="submit" class="btn btn-default">Sacar</button></div>
</form>
<p id="withdrawmsg"></p>
<br />
<p>Seus endere&ccedil;os:</p>
<form action="index.php" method="POST" id="newaddressform">
	<input type="hidden" name="action" value="new_address" />
	<button type="submit" class="btn btn-default">Gerar um novo endere&ccedil;o</button>
</form>
<p id="newaddressmsg"></p>
<br />
<table class="table table-bordered table-striped" id="alist">
<thead>
<tr>
<td>Endere&ccedil;o:</td>
<td>QR Code</td>
</tr>
</thead>
<tbody>
<?php
foreach ($addressList as $address)
{
echo "<tr><td>".$address."</t>";?>
<td><a href="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $address?>">
  <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $address?>" alt="QR Code" style="width:42px;height:42px;border:0;"></td><tr>
<?php
}
?>
</tbody>
</table>
<p>&Uacute;ltimas 10 transa&ccedil;&otilde;es:</p>
<table class="table table-bordered table-striped" id="txlist">
<thead>
   <tr>
      <td nowrap>Data</td>
      <td nowrap>Endere&ccedil;o</td>
      <td nowrap>Tipo</td>
      <td nowrap>Valor</td>
      <td nowrap>Taxa</td>
      <td nowrap>Confirma&ccedil;&otilde;es</td>
      <td nowrap>Info</td>
   </tr>
</thead>
<tbody>
   <?php
   $bold_txxs = "";
   foreach($transactionList as $transaction) {
      if($transaction['category']=="send") { $tx_type = '<b style="color: #FF0000;">Enviado</b>'; } else { $tx_type = '<b style="color: #01DF01;">Recebido</b>'; }
      echo '<tr>
               <td>'.date('n/j/Y h:i a',$transaction['time']).'</td>
               <td>'.$transaction['address'].'</td>
               <td>'.$tx_type.'</td>
               <td>'.abs($transaction['amount']).'</td>
               <td>'.$transaction['fee'].'</td>
               <td>'.$transaction['confirmations'].'</td>
               <td><a href="' . $blockchain_url,  $transaction['txid'] . '" target="_blank">Info</a></td>
            </tr>';
   }
   ?>
   </tbody>
</table>
<script type="text/javascript">
var blockchain_url = "<?=$blockchain_url?>";
$("#withdrawform input[name='action']").first().attr("name", "jsaction");
$("#newaddressform input[name='action']").first().attr("name", "jsaction");
$("#pwdform input[name='action']").first().attr("name", "jsaction");
$("#donate").click(function (e){
  $("#donateinfo").show();
  $("#withdrawform input[name='address']").val("<?=$donation_address?>");
  $("#withdrawform input[name='amount']").val("0.01");
});
$("#withdrawform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR)
        {
            var json = $.parseJSON(data);
            if (json.success)
            {
              $("#withdrawform input.form-control").val("");
            	$("#withdrawmsg").text(json.message);
            	$("#withdrawmsg").css("color", "green");
            	$("#withdrawmsg").show();
            	updateTables(json);
            } else {
            	$("#withdrawmsg").text(json.message);
            	$("#withdrawmsg").css("color", "red");
            	$("#withdrawmsg").show();
            }
            if (json.newtoken)
            {
              $('input[name="token"]').val(json.newtoken);
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            //ugh, gtfo
        }
    });
    e.preventDefault();
});
$("#newaddressform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR)
        {
            var json = $.parseJSON(data);
            if (json.success)
            {
            	$("#newaddressmsg").text(json.message);
            	$("#newaddressmsg").css("color", "green");
            	$("#newaddressmsg").show();
            	updateTables(json);
            } else {
            	$("#newaddressmsg").text(json.message);
            	$("#newaddressmsg").css("color", "red");
            	$("#newaddressmsg").show();
            }
            if (json.newtoken)
            {
              $('input[name="token"]').val(json.newtoken);
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            //ugh, gtfo
        }
    });
    e.preventDefault();
});
$("#pwdform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR)
        {
            var json = $.parseJSON(data);
            if (json.success)
            {
               $("#pwdform input.form-control").val("");
               $("#pwdmsg").text(json.message);
               $("#pwdmsg").css("color", "green");
               $("#pwdmsg").show();
            } else {
               $("#pwdmsg").text(json.message);
               $("#pwdmsg").css("color", "red");
               $("#pwdmsg").show();
            }
            if (json.newtoken)
            {
              $('input[name="token"]').val(json.newtoken);
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            //ugh, gtfo
        }
    });
    e.preventDefault();
});

function updateTables(json)
{
	$("#balance").text(json.balance.toFixed(8));
	$("#alist tbody tr").remove();
	for (var i = json.addressList.length - 1; i >= 0; i--) {
		$("#alist tbody").prepend("<tr><td>" + json.addressList[i] + "</td></tr>");
	}
	$("#txlist tbody tr").remove();
	for (var i = json.transactionList.length - 1; i >= 0; i--) {
		var tx_type = '<b style="color: #01DF01;">Recebido</b>';
		if(json.transactionList[i]['category']=="send")
		{
			tx_type = '<b style="color: #FF0000;">Enviado</b>';
		}
		$("#txlist tbody").prepend('<tr> \
               <td>' + moment(json.transactionList[i]['time'], "X").format('l hh:mm a') + '</td> \
               <td>' + json.transactionList[i]['address'] + '</td> \
               <td>' + tx_type + '</td> \
               <td>' + Math.abs(json.transactionList[i]['amount']) + '</td> \
               <td>' + json.transactionList[i]['fee'] + '</td> \
               <td>' + json.transactionList[i]['confirmations'] + '</td> \
               <td><a href="' + blockchain_url.replace("%s", json.transactionList[i]['txid']) + '" target="_blank">Info</a></td> \
            </tr>');
	}
}
</script>
