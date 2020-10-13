import { getRepository } from "typeorm";
import { Request, Response } from "express";
import { User } from "../entity/User";
import { validate } from "class-validator";

export class UserController {

    private userRepository = getRepository(User);

    static getAll = async (req: Request, res: Response) => {
        const userRepository = getRepository(User);
        const users = await userRepository.find();
        if (users.length > 0) {
            res.send(users);
        } else {
            res.status(404).json({ message: 'Not result.' });
        }
    };

    static getById = async (req: Request, res: Response) => {
        const { id } = req.params;
        const userRepository = getRepository(User);
        try {
            const user = await userRepository.findOneOrFail(id);
            res.send(user);
        } catch (error) {
            res.status(404).json({ message: 'Not result.' });
        }
    };

    static newUser = async (req: Request, res: Response) => {
        const { username, password, role } = req.body;
        const user = new User();
        user.username = username;
        user.password = password;
        user.role = role;
        //validate
        const validationOpt = { validationError: { terget: false, value: false } };
        const errores = await validate(user, validationOpt);
        if (errores.length > 0) {
            return res.status(400).json(errores);
        }

        // TODO: Hash PASSWORD.

        const userRepository = getRepository(User);
        try {
            user.hashPassword();
            await userRepository.save(user);
        } catch (error) {
            res.status(409).json({ message: 'Username already exist.' });
        }
        // All Okey
        res.send('User Create.');
    };

    static editUser = async (req: Request, res: Response) => {
        let user: any;
        const { id } = req.params;
        const { username, role } = req.body;
        const userRepository = getRepository(User);

        try {
            user = await userRepository.findOneOrFail(id);
            user.username = username;
            user.role = role;
        } catch (error) {
            res.status(404).json({ message: 'User not Found.' });
        }
        const validationOpt = { validationError: { terget: false, value: false } };
        const errores = await validate(user, validationOpt);
        if (errores.length > 0) {
            return res.status(400).json(errores);
        }

        // Try to save user
        try {
            await userRepository.save(user);
        } catch (error) {
            res.status(404).json({ message: 'Username already in use.' });
        }
        res.status(201).json({ message: 'User update.' });
    };

    static deleteUser = async (req: Request, res: Response) => {
        const { id } = req.params;
        const userRepository = getRepository(User);
        let user: User;

        try {
            user = await userRepository.findOneOrFail(id);
        } catch (error) {
            res.status(404).json({ message: 'User not Found.' });
        }

        // Try to delete user
        try {
            await userRepository.delete(id);
        } catch (error) {
            res.status(2001).json({ message: 'Error User ot deleted.' });
        }
        res.status(201).json({ message: 'User deleted.' });
    };
}

export default UserController;