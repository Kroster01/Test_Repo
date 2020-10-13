import { checkJwt } from "./../middlewares/jwt";
import { Router } from "express";
import { UserController } from "../controller/UserController";
import { checkRole } from '../middlewares/role';

const router = Router();

// Get al users
router.get('/', [checkJwt, checkRole(['admin'])], UserController.getAll);

// Get one User
router.get('/:id', [checkJwt, checkRole(['admin'])], UserController.getById);

// Create a new User solo el admin puede crear users
router.post('/', [checkJwt, checkRole(['admin'])], UserController.newUser);

// Edit User
router.patch('/:id', [checkJwt, checkRole(['admin'])], UserController.editUser);

// Delete User
router.delete('/:id', [checkJwt, checkRole(['admin'])], UserController.deleteUser);

export default router;