import { getRepository } from "typeorm";
import { Request, Response } from "express";
import { User } from "../entity/User";
import * as jwt from "jsonwebtoken";
import config from "../config/config";
import { validate } from "class-validator";

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
    static changePassword = async (req: Request, res: Response) => {
        const {userId} = res.locals.jwtPayload;
        const {oldPassword, newPassword} = req.body;
        if (!(oldPassword && newPassword)) {
            return res.status(400).json({ message: 'Old password & New Password are Requered' });
        }
        const userRepository = getRepository(User);
        let user: User;
        try {
            user = await userRepository.findOneOrFail({ where: { userId } });
        } catch (error) {
            return res.status(400).json({ message: 'Somethings goes wrong!' });
        }
        if (!user.chackPassword(oldPassword)) {
            return res.status(401).json({ message: 'Check yuor old Password.' });
        }
        user.password = newPassword;
        const validationOpt = { validationError: { terget: false, value: false } };
        const errores = await validate(user, validationOpt);
        if (errores.length > 0) {
            return res.status(400).json(errores);
        }
        // hash password
        user.hashPassword();

        try {
            user.hashPassword();
            await userRepository.save(user);
        } catch (error) {
            res.status(409).json({ message: 'Passsword not change.' });
        }
        // All Okey
        res.send('Passsword change!.');


    }

}

export default AuthController;