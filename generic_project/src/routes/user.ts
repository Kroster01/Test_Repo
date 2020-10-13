import { Router } from "express";
import { UserController } from "../controller/UserController";

const router = Router();

// Get al users
router.get('/', UserController.getAll);

// Get one User
router.get('/:id', UserController.getById);

// Create a new User
router.post('/', UserController.newUser);

// Edit User
router.patch('/:id', UserController.editUser);

// Delete User
router.delete('/:id', UserController.deleteUser);

export default router;