async function getProductByID(productID) {
    const url = "productdetail.php";

    const data = { id: productID };

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'Accept': 'application/json;charset=UTF-8'
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();

    const divresult = document.querySelector('#result');

    divresult.innerHTML = result.product_description;
}