var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', {
      title: 'NFD',
      body: 'No more Freezing SSD'
   });
});

module.exports = router;
