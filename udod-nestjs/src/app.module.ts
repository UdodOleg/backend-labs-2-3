import { Module } from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { ConfigModule } from '@nestjs/config';
import { CategoriesModule } from './categories/categories.module';
import { ProductsModule } from './products/products.module';
import { Category } from './entities/category.entity';
import { Product } from './entities/product.entity';

@Module({
  imports: [
    ConfigModule.forRoot({
      envFilePath: 'db.env',
    }),
    TypeOrmModule.forRoot({
      type: 'postgres',
      host: 'localhost',
      port: 5432,
      username: 'postgres',
      password: '12345',
      database: 'projectdb',
      entities: [Category, Product], // явно вказуємо наші entity
      autoLoadEntities: true,
      synchronize: true,
    }),
    CategoriesModule, // підключаємо модуль категорій
    ProductsModule,   // підключаємо модуль продуктів
  ],
})
export class AppModule {}