import { getRepository } from 'typeorm';
import { Request, Response } from 'express';
import { Users } from '../entity/Users';
import * as jwt from 'jsonwebtoken';
import config from '../config/config';
import { validate } from 'class-validator';
import { Userad } from '../entity/Userad';

class AuthController {
  static login = async (req: Request, res: Response) => {
    let userId = 0;
    let userUsername = '';
    let userRole = '';
    const { username, password } = req.body;
    if (!(username && password)) {
      return res.status(400).json({ message: ' Username & Password are required!' });
    }
    const user: Users = await AuthController.findUsers(username);
    let userAd: Userad;
    if (user === null) {
      userAd = await AuthController.findUserAd(username);
      if (userAd === null) {
        return res.status(400).json({ message: ' Username or password incorecct!' });
      } else {
        // Check password
        if (!userAd.checkPassword(password)) {
          return res.status(400).json({ message: 'Username or Password are incorrect!' });
        }
        userId = userAd.id;
        userUsername = userAd.username;
        userRole = userAd.role;
      }
    } else {
      // Check password
      if (!user.checkPassword(password)) {
        return res.status(400).json({ message: 'Username or Password are incorrect!' });
      }
      userId = user.id;
      userUsername = user.username;
      userRole = user.role;
    }
    const token = jwt.sign({ userId, username: userUsername }, config.jwtSecret, { expiresIn: '1h' });
    res.json({ message: 'OK', token, userId, role: userRole, username: userUsername });
  }

  static changePassword = async (req: Request, res: Response) => {
    const { userId } = res.locals.jwtPayload;
    const { oldPassword, newPassword } = req.body;

    if (!(oldPassword && newPassword)) {
      res.status(400).json({ message: 'Old password & new password are required' });
    }

    const userRepository = getRepository(Users);
    let user: Users;

    try {
      user = await userRepository.findOneOrFail(userId);
    } catch (e) {
      res.status(400).json({ message: 'Somenthing goes wrong!' });
    }

    if (!user.checkPassword(oldPassword)) {
      return res.status(401).json({ message: 'Check your old Password' });
    }

    user.password = newPassword;
    const validationOps = { validationError: { target: false, value: false } };
    const errors = await validate(user, validationOps);

    if (errors.length > 0) {
      return res.status(400).json(errors);
    }

    // Hash password
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

  private static async findUsers(username: any) {
    const userRepository = getRepository(Users);
    let user: Users;
    try {
      user = await userRepository.findOneOrFail({ where: { username } });
    } catch (e) {
      // return res.status(400).json({ message: ' Username or password incorecct!' });
      return null;
    }
    return user;
  }

  private static async findUserAd(username: any) {
    const userAdRepository = getRepository(Userad);
    let userad: Userad;
    try {
      userad = await userAdRepository.findOneOrFail({ where: { username } });
    } catch (e) {
      if (e.name === 'EntityNotFound') { }
      const name = e.name;
      const message = e.message;
      // return res.status(400).json({ message: ' Username or password incorecct! ad 1 ', name, message });
      return null;
    }
    return userad;
  }

}
export default AuthController;
