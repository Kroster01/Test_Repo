import { Entity, PrimaryGeneratedColumn, Column, Unique, CreateDateColumn, UpdateDateColumn } from "typeorm";
import { MinLength, IsNotEmpty, IsEmail } from "class-validator";
import * as bcryptjs from "bcryptjs";
//  TODO: IsEmail
@Entity()
@Unique(['username'])
export class User {

    @PrimaryGeneratedColumn()
    id: number;

    @Column()
    @MinLength(6)
    username: string;

    @Column()
    @MinLength(6)
    password: string;

    @Column()
    @IsNotEmpty()
    role: string;

    @Column()
    @CreateDateColumn()
    createdAt: string;

    @Column()
    @UpdateDateColumn()
    updatedAt: string;

    hashPassword(): void {
        const salt = bcryptjs.genSaltSync(10);
        this.password = bcryptjs.hashSync(this.password, salt);
    }

    chackPassword(password: string): boolean {
        return bcryptjs.compareSync(password, this.password);
    }
}