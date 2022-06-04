const bodyParser = require('body-parser')
const express = require('express')
const cors = require('cors')
const { db } = require('./model/db_connection')
const app = express()
const port = 3000

app.use(express.json())
app.use(bodyParser.urlencoded({ extended: true }));
app.use(cors())

app.post('/login', function (req, res) {
    const username = req.body.username;
    const password = req.body.password;
    const loginQuery = `SELECT * FROM users WHERE username = '${username}' AND password = '${password}'`
    db.query(loginQuery, (err, result) => {
        if (result[0] != null) {
            let data = {
                status: true,
                message: "Login Success!"
            };

            res.send(data)
        } else {
            let data = {
                status: false,
                message: "Wrong username or password"
            };

            res.send(data)
        }
    })
})
app.post('/register', function (req, res) {
    const username = req.body.username;
    const password = req.body.password;
    const insertQuery = `INSERT INTO users (username, password) VALUE('${username}','${password}')`
    const checkQuery = `SELECT * FROM users WHERE username = '${username}'`
    db.query(checkQuery, (err, result) => {
        if (!result[0]) {
            db.query(insertQuery, (err, result) => {
                let data = {
                    status: true,
                    message: "Register Success!"
                };
                res.send(data)
            })
        } else {
            let data = {
                status: false,
                message: "Username already used"
            };
            res.send(data)
        }
    })
})
app.get('/showinventory', function (req, res) {
    const showInventoryQuery = `SELECT * FROM inventory`
    db.query(showInventoryQuery, (err, result) => {
        let data = {
            status: true,
            message: "Show Inventory Success!",
            result: result
        };
        res.send(data)
    })
})

app.post('/delete', function (req, res) {
    const id = req.body.id;

    const sqlQuery = `DELETE FROM inventory WHERE id='${id}'`
    db.query(sqlQuery, (err, result) => {
        if (!err) {
            let data = {
                status: true,
                message: "Delete Sucessfull!",
            };
            res.send(data)
        } else {
            let data = {
                status: false,
                message: "Delete Failed!",
            };
            res.send(data)
        }
    })
})

app.post('/addinventory', function (req, res) {
    const name = req.body.name;
    const stock = req.body.stock;
    const sqlQuery = `INSERT INTO inventory (name, stock, id) VALUES ('${name}', '${stock}', NULL)`
    db.query(sqlQuery, (err, result) => {
        if (err) {
            let data = {
                status: false,
                message: "Insert Data Failed!",
            };
            res.send(data)
        } else {
            let data = {
                status: true,
                message: "Insert Data Sucessfull!",
            };
            res.send(data)
        }
    })
})

app.listen(port, function () {
    console.log(`Berhasil berjalan di port : ${port}`)
})