<?php

/*
Arquivo de configuração do ambiente
*/

$sandBox = 1;

if (!($sandBox)) {
	$emailPagseguro = "bruno@minharevisao.com.br";
	$tokenPagseguro = "6e65d75d-db69-4f84-86f9-d5fe1656aada6f2d4f5f416bbc4474f288d15371650e522c-d5e3-4539-8714-f39f92db5af1";//chave dev ABFAD33FFAFAE4ADD4A87F967EAC2D01 // chave venda online 6e65d75d-db69-4f84-86f9-d5fe1656aada6f2d4f5f416bbc4474f288d15371650e522c-d5e3-4539-8714-f39f92db5af1
	$urlNotificacao = "https://www.minharevisao.dev.br/agenda/notificacao.php";

	$scriptPagseguro = "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
	$urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/";

} else {
	$emailPagseguro = "bruno@minharevisao.com.br";
	$tokenPagseguro = "6e65d75d-db69-4f84-86f9-d5fe1656aada6f2d4f5f416bbc4474f288d15371650e522c-d5e3-4539-8714-f39f92db5af1";
	$urlNotificacao = "https://www.minharevisao.dev.br/agenda/notificacao.php";

	$scriptPagseguro = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
	$urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/";
}
