"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const gameController_1 = __importDefault(require("../controllers/gameController"));
class GamesRouter {
    constructor() {
        this.router = express_1.Router();
        this.config();
        this.routes();
    }
    ;
    config() {
        // listar juegos.
        this.router.get('/', gameController_1.default.list);
        // listar juegos.
        this.router.get('/:id', gameController_1.default.getOne);
        // Crear juegos.
        this.router.post('/', gameController_1.default.create);
        // Eliminar juegos.
        this.router.delete('/:id', gameController_1.default.delete);
        // actualziar juegos.
        this.router.put('/:id', gameController_1.default.update);
    }
    routes() {
    }
    start() {
    }
}
const gmesRoutes = new GamesRouter();
exports.default = gmesRoutes.router;
