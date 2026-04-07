function openSearch() {
    document.getElementById('myOverlay').style.display = 'block';
}

function closeSearch() {
    document.getElementById('myOverlay').style.display = 'none';
}

// Optionally, handle AJAX search submission
document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    const query = document.getElementById('searchQuery').value;
    
    // AJAX request to search.php
    fetch('../php/search.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams('search_query=' + query)
    })
    .then(response => response.text())
    .then(data => {
        document.querySelector('.overlay-content').innerHTML = data;
    });
});
