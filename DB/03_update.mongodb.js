use("ecommerce");

// Update price of Wireless Mouse to 899

// db.products.updateOne(
// { name: "Wireless Mouse" },
// { $set: { price: 899 } }
// )



// increment stock by 10 for all electronics

// db.products.updateMany(
// { category: "Electronics" },
// {$inc: {stock: 11}})


// Add "Mouse" tag to Wireless Mouse

db.products.updateOne(
{ name: "Wireless Mouse" },
{ $push: { tags: "Mouse" } }
)