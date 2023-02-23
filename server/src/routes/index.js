const router = require("express").Router();
const { home, emergency } = require("../controllers/index.controller");

router.post("/", home);

// router.get("/", async (req, res, next) => {
//     return res.status(200).json({
//         success: true,
//         message: "Holla"
//     })
// })

router.post("/emergency", emergency);

module.exports = router;