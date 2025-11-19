// Click Event Function to add items to the cart
$(document).ready(function() {
  $('.add-to-cart').click(function() {
    let event_id = $(this).data('event-id');

    $.ajax({
      url: '../php/add_cart.php',
      type: 'POST',
      data: { event_id: event_id },
      success: function(response) {
        try {
          let result = typeof response === "object" ? response : JSON.parse(response);
          alert(result.message);
        } catch (e) {
          alert('Erro inesperado: ' + response);
        }
      },
      error: function(xhr) {
        alert('Erro ao adicionar o evento ao carrinho.');
      }
    });
  });
});