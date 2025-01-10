Multi Vendor Store

Database

products =[
id (PK)
slug (unique)
description
category_id (FK)
store_id (FK)
price
images
created_at
updated_at
]

categories = [
id (PK)
name
slug (unique)
description
created_at
updated_at
]

stores = [
id (PK)
name
created_at
updated_at
]

cart = [
id (PK)
user_id (FK)
product_id (FK)
quantity
totalPrice

created_at
updated_at
]

order = [
id (PK)
number
user_id (FK)
status
created_at
updated_at
]

order_items = [
id (PK)
order_id (FK)
product_id (FK)
quantity
created_at
updated_at
]
