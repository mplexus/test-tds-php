<?php
       $httpContextOptions = [
           'http' => [
               'method' => 'POST',
               'content' => json_encode([
                  'card'  => [
                    'number' => '5892420000000943',
                    'holder_name' => 'Mike Plexousakis',
                    'cvv' => '347',
                    'exp_month' => '01',
                    'exp_year' => '20'
                  ],
                  'amount' => '1800',
                  'pk' => 'pk_nknDsvb04gH36GTIO2Ho2n5VbUukkVTQ'
               ]),
               'header' => 'Content-Type: application/json',
           ]
       ];
       $uri = 'http://checkout.torawallet.local/threedsecure';

       $context = stream_context_create($httpContextOptions);
       $fp = fopen($uri, 'r', false, $context);
       $response = stream_get_contents($fp);
       fclose($fp);

       $ra = json_decode($response, true);
?>

<html>
<head>
</head>
<body>
Will POST to <?= $ra['url'] ?>
<br/><br/>
<form method="POST" action="<?= $ra['url'] ?>" target="tds">
<textarea rows="10" cols="80" name="PaReq"><?= $ra['payload']['pares'] ?></textarea>
<br/><br/>
<input style="width:500;" value="<?= $ra['term_url'] ?>" type="text" name="TermUrl"/>
<br/><br/>
<input style="width:500;" value="<?= $ra['md'] ?>" name="MD" type="text"/>
<br/><br/>
<input type="submit"/>
</form>
<iframe name="tds" id="tds" src="" width="500" height="500"></iframe>
<script type="text/javascript">
  window.addEventListener("message", function(e){
	console.log(JSON.parse(e.data)); }, false);
</script>
</body>
</html>
