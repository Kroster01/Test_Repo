import { checkJwt } from './../middlewares/jwt';
import { Router } from 'express';
import { UserController } from '../controller/UserController';
import { checkRole } from '../middlewares/role';

const router = Router();

// Get al users
router.get('/', UserController.getAll);

// Get one User
router.get('/:id', [checkJwt, checkRole(['admin'])], UserController.getById);

// Create a new User solo el admin puede crear users
router.post('/', [checkJwt, checkRole(['admin'])], UserController.new);

// Edit User
router.patch('/:id', [checkJwt, checkRole(['admin'])], UserController.edit);

// Delete User
router.delete('/:id', [checkJwt, checkRole(['admin'])], UserController.delete);

export default router;
