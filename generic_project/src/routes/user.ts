import { checkJwt } from "./../middlewares/jwt";
import { Router } from "express";
import { UserController } from "../controller/UserController";

const router = Router();

// Get al users
router.get('/', [checkJwt], UserController.getAll);

// Get one User
router.get('/:id', [checkJwt], UserController.getById);

// Create a new User
router.post('/', [checkJwt], UserController.newUser);

// Edit User
router.patch('/:id', [checkJwt], UserController.editUser);

// Delete User
router.delete('/:id', [checkJwt], UserController.deleteUser);

export default router;