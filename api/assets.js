import express from "express";
const app = express();

app.use('assets', express.static('public'));

export default app;