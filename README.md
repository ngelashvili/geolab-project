Request:
````

mutation {
    getOrderData(orderId: "wwTzOABy2idCh4U9iDdUGypphtNGMo3b"){
    orderNumber,
    order_date,
    items {
        id,
        name,
        sku,
        price,
        quantity
    }
  }
}

````

Response:
````
{
    "data": {
        "getOrderData": {
            "orderNumber": "000000001",
            "order_date": "2022-05-20 07:39:44",
            "items": [
                {
                    "id": "2",
                    "name": "testing",
                    "sku": "testing",
                    "price": 100,
                    "quantity": 1
                }
            ]
        }
    }
}
````
