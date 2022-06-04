const mysql = require('mysql')

const db = mysql.createPool({
    host: '192.168.236.128',
    user: 'root',
    password: '123190084',
    database: 'cloud9',
    port: '/var/run/mysqld/mysqld.sock'
})

exports.db = db;