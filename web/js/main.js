
// Mascara para telefone
$(function() {
    $('.phone-mask').mask('(00) 00000-0000');
    $('.money-mask').maskMoney({ prefix:'R$', thousands:'.', decimal:',', affixesStay: true });
    $('.cep-mask').mask('00000-000');
    $('.datepicker').datepicker({
        language: 'pt-BR',
        format: "dd/mm/yyyy"
    });
});





