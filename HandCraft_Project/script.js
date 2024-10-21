$(document).ready(function() {
    // Fetch and display cart and wishlist counts when the page loads
    updateCartCount();
    updateWishlistCount();

    // Add to cart functionality
    $(document).ready(function() {
        // Handle Add to Cart click
        $('.add-to-cart').click(function() {
            var product_id = $(this).data('id');
            var user_id = 1; // Example user ID, you need to replace this with the actual logged-in user ID
    
            $.ajax({
                url: 'add_to_cart.php',
                type: 'POST',
                data: {
                    user_id: user_id,
                    product_id: product_id
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert("Product added to cart!");
                    } else {
                        alert("Error adding product to cart: " + result.message);
                    }
                },
                error: function() {
                    alert("An error occurred while adding the product to the cart.");
                }
            });
        });
    });
    

// Add to wishlist functionality
$(".add-to-wishlist").click(function () {
    var productId = $(this).data("id");
    $.post("add_to_wishlist.php", { product_id: productId }, function (data) {
        console.log(data);  // Log the response to check its structure
        alert(data.message);
        updateWishlistCount();
    }, "json");
});


    // Function to update cart count
    function updateCartCount() {
        $.get("cart_count.php", function (data) {
            $("#cart-count").text(data.count);
        }, "json");
    }

    // Function to update wishlist count
    function updateWishlistCount() {
        $.get("wishlist_count.php", function (data) {
            $("#wishlist-count").text(data.count);
        }, "json");
    }

    // Open login modal when profile icon is clicked
    $('.icon-btn').click(function() {
        $('#loginModal').modal('show');
    });

    $.get("check_login.php", function(data) {
        if (data.loggedIn) {
            alert("Welcome back, " + data.username + "!");
            // Optionally hide the login button and show the logout button
        }
    }, "json");

});
