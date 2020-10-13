import { getRepository } from "typeorm";
import { Request, Response } from "express";
import { User } from "../entity/User";
import * as jwt from "jsonwebtoken";
import config from "../config/config";

class AuthController {
    constructor() {

    }
    static login = async (req: Request, res: Response) => {
        const { username, password } = req.body;
        if (!(username && password)) {
            return res.status(400).json({ message: 'Username & Password are requiered!' });
        }
        const userRepository = getRepository(User);
        let user: User;
        try {
            user = await userRepository.findOneOrFail({ where: { username: username } });
        } catch (error) {
            return res.status(400).json({ message: 'Username or Password incorecct!' });
        }
        // check password
        if (!user.chackPassword(password)) {
            return res.status(400).json({ message: 'Username or Password are incorecct!' });
        }

        const token = jwt.sign({ userId: user.id, username: user.username }, config.jwtSecret, { expiresIn: '1h' });
        res.json({ message: 'OK', token });
    }
}

export default AuthController;