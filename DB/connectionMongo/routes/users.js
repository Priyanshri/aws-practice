const express = require("express");
const router = express.Router();

const User = require("../models/userModel");

//create
router.post('/users', async (req, res) => {
    console.log("Received request for POST method");
    try {
        const { name, age, weight } = req.body;
        const newUser = new User({ name, age, weight });
        await newUser.save();
        res.status(200).json({
            success: true,
            data: newUser
        });
    }
    catch (err) {
        res.status(500).json({
            success: false,
            message: err.message
        })
    }
})

//View/Read
router.get('/users', async (req, res) => {
    try {
        const users = await User.find();
        res.status(200).json(users);
    }
    catch (err) {
        res.status(500).json({
            success: false,
            message: err.message
        })
    }
});

//update
router.put('/users/:id', async (req, res) => {
    const { id } = req.params;
    const { name, age, weight } = req.body;
    try {
        const updatedUser = await User.findByIdAndUpdate(id, { name, age, weight }, { new: true });
        if (!updatedUser) {
            res.status(404).json({
                success: false,
                message: "User not found"
            });
        }
        res.status(200).json({
            success: true,
            user: updatedUser
        })
    }
    catch (err) {
        res.status(500).json({
            success: false,
            message: err.message
        })
    }
});

//delete
router.delete('/users/:id', async (req, res) => {
    const { id } = req.params;
    try {
        const deletedUser = await User.findByIdAndDelete(id);
        if (!deletedUser) {
            res.status(404).json({
                success: false,
                message: "User not found"
            });
        }
        res.status(200).json({
            success: true,
            user: deletedUser
        })
    }
    catch (err) {
        res.status(500).json({
            success: false,
            message: err.message
        })
    }
});

module.exports = router;