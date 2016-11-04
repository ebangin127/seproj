var express = require('express');
var router = express.Router();
var sql = require("./sql.js");      /* sql query */

/* GET home page. */
router.get('/', function(req, res, next) {
    res.render('index', {
        title: 'NFD'
    });
});

module.exports = router
