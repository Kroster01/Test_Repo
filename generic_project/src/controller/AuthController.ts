import { getRepository } from "typeorm";
import { Request, Response } from "express";
import { User } from "../entity/User";

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
        res.send(user);
    }
}

export default AuthController;