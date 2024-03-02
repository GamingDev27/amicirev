function refresh() {
    $.get('/verify-session',(data, status) => {
        console.log(data);
    });    
    setTimeout(refresh, 15000);

}


setTimeout(refresh, 15000);