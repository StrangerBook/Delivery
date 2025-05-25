
function formatarPreco(input) {
  // Remove tudo que não for dígito
  let valor = input.value.replace(/\D/g, '');

  // Limita para no máximo 5 dígitos (3 inteiros + 2 decimais)
  if (valor.length > 5) valor = valor.slice(0, 5);

  if (valor.length > 2) {
    let parteInteira = valor.slice(0, valor.length - 2);
    let parteDecimal = valor.slice(-2);
    input.value = parteInteira + ',' + parteDecimal;
  } else {
    input.value = valor;
  }
}
