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
    const titleModel = document.querySelector('#titleModel');
    const image = document.querySelector('#image');

    divresult.innerHTML = result.product_description;
    titleModel.innerHTML = result.product_name;

    var myModal = new bootstrap.Modal(document.getElementById('productModel'));
    myModal.show();
}

async function getProductsByCategory() {

    const url = "productdetail2.php";
    const checkbox = document.querySelectorAll('.checkbox');
    const data = { ids: [] };
checkbox.forEach(element => {
    if(element.checked){
        data.ids.push({id : element.value});

    }
});

/*
    var id = [];
    checkbox.forEach(element => {
    if(element.checked){
        id.push({element.id});
    }
    });

    const data = { 'id': id };

const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'Accept': 'application/json;charset=UTF-8'
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();

    const divresult = document.querySelector('#cardID');

    let noidung = '';
    
    var i;
    for (i = 0; i < result.length; i++) {
        noidung +=  `<div class="col-md-4">
        <div class="card">
            <a href="product.php/<?php echo $productPath; ?>">
                <img src="./public/images/${result[i].product_photo}" class="card-img-top" alt="...">
            </a>
            <div class="card-body">
                <h5 class="card-title" onclick="getProductByID(${result[i].id})">${result[i].product_name}</h5>
                <p class="card-text">${result[i].product_price}</p>
            </div>
        </div>
      </div>`;
      }

divresult.innerHTML =  noidung;
*/

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'Accept': 'application/json;charset=UTF-8'
        },
        body: JSON.stringify(data)
    });

    

    const result = await response.json();

    const divresult = document.querySelector('#cardID');


    let arr = [];
    if (data.ids.length ===0) {
        arr = result
    }
    else{
        result.forEach(element =>{
            arr =[...arr,...element]
        })
    }
   


let noidung = '';
var i;
    for (i = 0; i < arr.length; i++) {
        noidung +=  `<div class="col-md-4">
        <div class="card">
            <a href="product.php/<?php echo $productPath; ?>">
                <img src="./public/images/${arr[i].product_photo}" class="card-img-top" alt="...">
            </a>
            <div class="card-body">
                <h5 class="card-title" onclick="getProductByID(${arr[i].id})">${arr[i].product_name}</h5>
                <p class="card-text">${arr[i].product_price}</p>
            </div>
        </div>
      </div>`;
      }

divresult.innerHTML =  noidung;
}

async function searchProduct() {
    
    const url = "productsearchdetail.php";
    const kqtimkiem = document.querySelector('.ketqua');

    const key = document.getElementById("search1").value;

    const data = { 'key' :  key};

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'Accept': 'application/json;charset=UTF-8'
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();
    
    kqtimkiem.innerHTML = "";
    let ketqua = "";
    if(result.length != 0){
        kqtimkiem.style.display = "block";
        for(let i =0; i < result.length; i++){
            kqtimkiem.innerHTML += `
            <div class="nametext">
                <a href="product.php/${result[i].product_name}-${result[i].id}">
                    ${result[i].product_name}
                </a>
            </div>
            
            `;
        }
    }else{
        kqtimkiem.style.display = "none";
        kqtimkiem.innerHTML = "";
    }
    
}
