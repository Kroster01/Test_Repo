"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const databases_1 = __importDefault(require("../databases"));
class GameController {
    list(req, res) {
        return __awaiter(this, void 0, void 0, function* () {
            const games = yield databases_1.default.query('SELECT * FROM games');
            res.json(games);
        });
    }
    getOne(req, res) {
        return __awaiter(this, void 0, void 0, function* () {
            const { id } = req.params;
            const games = yield databases_1.default.query('SELECT * FROM games WHERE id = ?', [id]);
            if (games.length > 0) {
                return res.json(games[0]);
            }
            res.status(404).json({ text: 'The game dosen´t exists.' });
        });
    }
    create(req, res) {
        return __awaiter(this, void 0, void 0, function* () {
            const valuee = yield databases_1.default.query('INSERT INTO games set ? ', [req.body]);
            //valuee: {"fieldCount":0,"affectedRows":1,"insertId":3,"serverStatus":2,"warningCount":0,"message":"","protocol41":true,"changedRows":0}
            //console.log("valuee: " + JSON.stringify(valuee));
            res.json({ message: 'The game was saved.' });
        });
    }
    update(req, res) {
        return __awaiter(this, void 0, void 0, function* () {
            const { id } = req.params;
            const games = yield databases_1.default.query('UPDATE games set ? WHERE id = ?', [req.body, id]);
            res.json({ message: 'the game was updated.' });
        });
    }
    delete(req, res) {
        return __awaiter(this, void 0, void 0, function* () {
            const { id } = req.params;
            const games = yield databases_1.default.query('DELETE FROM games WHERE id = ?', [id]);
            res.json({ message: 'the game was deleted.' });
        });
    }
}
const gameController = new GameController();
exports.default = gameController;
