function refresh() {

    fetch('/verify-session')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if(!data.isValidSession){
            window.location.href = "/logout";
        }
        setTimeout(refresh, 60000);
    })
    .catch(error => {
        console.error('Error:', error);
    });

}


setTimeout(refresh, 60000);