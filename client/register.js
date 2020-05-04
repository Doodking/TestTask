async function postData(){
    let sum = document.getElementById('sum').value ,
        porpose = document.getElementById('porpose').value; 
    let formData = new FormData();
    formData.append('sum', sum);
    formData.append('porpose', porpose);    
    const res = await fetch('http://localhost/test/backend/index.php?q=register', {
        method: 'POST',
        body: formData
    });
    const data = await res.json();
    let hash = generateId();
    location.replace("http://localhost/test/client/payment.html?sessionId=" + hash);
}

async function getData(){
    let res = await fetch("http://localhost/test/backend/index.php?q=data");
    let orders = await res.json();

    orders.forEach((order) => {
        document.querySelector('.order').innerHTML += `
                <h5>${order.sum} => ${order.porpose}</h5>
        `
    });
}

async function postPayment(){
    let name = document.getElementById('name').value,
        number = document.getElementById('number').value,
        expiration = document.getElementById('expiration').value,
        cvv = document.getElementById('cvv').value; 
    let formData2 = new FormData();
    formData2.append('name', name);
    formData2.append('number', number);
    formData2.append('expiration', expiration);
    formData2.append('cvv', cvv);
    const res = await fetch('http://localhost/test/backend/index.php?q=pay', {
        method: 'POST',
        body: formData2
    });
    const data = await res.json();
    if(data.status == true){
        alert('You have successfully paid for the order!');
        location.replace('http://localhost/test/index.html');
    }else{alert('Bad credit number(');}
    const del = await fetch('http://localhost/test/backend/index.php?q=delete', {
        method: 'DELETE'
    });
}

function byteToHex(byte) {
    return ('0' + byte.toString(16)).slice(-2);
  }
  
function generateId(len = 40) {
    var arr = new Uint8Array(len / 2);
    window.crypto.getRandomValues(arr);
    return Array.from(arr, byteToHex).join("");
}

getData();
  
