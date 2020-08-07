import { Request, Response } from 'express';
import pool from "../databases";

class GameController {
    public async list(req: Request, res: Response) {
        const games = await pool.query('SELECT * FROM games');
        res.json(games);
    }

    public async getOne(req: Request, res: Response): Promise<any> {
        const { id } = req.params
        const games = await pool.query('SELECT * FROM games WHERE id = ?', [id]);
        if (games.length > 0) {
            return res.json(games[0]);
        }
        res.status(404).json({ text: 'The game dosen´t exists.' });
    }

    public async create(req: Request, res: Response): Promise<void> {
        const valuee = await pool.query('INSERT INTO games set ? ', [req.body]);
        //valuee: {"fieldCount":0,"affectedRows":1,"insertId":3,"serverStatus":2,"warningCount":0,"message":"","protocol41":true,"changedRows":0}
        //console.log("valuee: " + JSON.stringify(valuee));
        res.json({ message: 'The game was saved.' });
    }

    public async update(req: Request, res: Response): Promise<void> {
        const { id } = req.params
        const games = await pool.query('UPDATE games set ? WHERE id = ?', [req.body, id]);
        res.json({ message: 'the game was updated.'});
    }

    public async delete(req: Request, res: Response): Promise<void> {
        const { id } = req.params
        const games = await pool.query('DELETE FROM games WHERE id = ?', [id]);
        res.json({ message: 'the game was deleted.'});
    }
}

const gameController = new GameController();
export default gameController;