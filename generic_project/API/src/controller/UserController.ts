import { getRepository } from "typeorm";
import { Request, Response } from "express";
import { Users } from "../entity/Users";
import { validate } from "class-validator";

export class UserController {

    private userRepository = getRepository(Users);

    static getAll = async (req: Request, res: Response) => {
        const userRepository = getRepository(Users);
        let users: any;
        try {
            users = await userRepository.find();
        } catch (error) {
            res.status(404).json({ message: 'Something goes wrong!' });
        }

        if (users.length > 0) {
            res.send(users);
        } else {
            res.status(404).json({ message: 'Not result.' });
        }
    };

    static getById = async (req: Request, res: Response) => {
        const { id } = req.params;
        const userRepository = getRepository(Users);
        try {
            const user = await userRepository.findOneOrFail(id);
            res.send(user);
        } catch (error) {
            res.status(404).json({ message: 'Not result.' });
        }
    };

    static new = async (req: Request, res: Response) => {
        const { username, password, role } = req.body;
        const user = new Users();
        user.username = username;
        user.password = password;
        user.role = role;
        //validate
        const validationOps = { validationError: { target: false, value: false } };
        const errors = await validate(user, validationOps);
        if (errors.length > 0) {
            return res.status(400).json(errors);
        }

        // TODO: Hash PASSWORD.

        const userRepository = getRepository(Users);
        try {
            user.hashPassword();
            await userRepository.save(user);
        } catch (error) {
            res.status(409).json({ message: 'Username already exist.' });
        }
        // All Okey
        res.send('User Create.');
    };

    static edit = async (req: Request, res: Response) => {
        let user: any;
        const { id } = req.params;
        const { username, role } = req.body;
        const userRepository = getRepository(Users);

        try {
            user = await userRepository.findOneOrFail(id);
            user.username = username;
            user.role = role;
        } catch (error) {
            res.status(404).json({ message: 'User not Found.' });
        }
        const validationOps = { validationError: { target: false, value: false } };
        const errors = await validate(user, validationOps);
        if (errors.length > 0) {
            return res.status(400).json(errors);
        }

        // Try to save user
        try {
            await userRepository.save(user);
        } catch (error) {
            res.status(404).json({ message: 'Username already in use.' });
        }
        res.status(201).json({ message: 'User update.' });
    };

    static delete = async (req: Request, res: Response) => {
        const { id } = req.params;
        const userRepository = getRepository(Users);
        let user: Users;

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