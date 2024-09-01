<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_1 = 'product_1';
    public const PRODUCT_2 = 'product_2';
    public const PRODUCT_3 = 'product_3';
    public const IMAGE_EXAMPLE_FILE_PATH = '/Images/Product/';
    public const IMAGE_EXAMPLE_FILE_NAME = 'example.png';
    public const IMAGE_EXAMPLE_COPY_FILE_NAME = 'example-copy.png';
    public const IMAGE_EXAMPLE_MIME_TYPE = 'image/png';

    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName('Product 1');
        $product1->setPrice(42.22);
        $product1->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $product1->setCategory($this->getReference(CategoryFixtures::CATEGORY_1));
        $product1->setImageFile($this->getImageUploadedFileExample());
        $product1->setImageName(self::IMAGE_EXAMPLE_FILE_NAME);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Product 2');
        $product2->setPrice(12.22);
        $product2->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $product2->setCategory($this->getReference(CategoryFixtures::CATEGORY_1));
        $product2->setImageFile($this->getImageUploadedFileExample());
        $product2->setImageName(self::IMAGE_EXAMPLE_FILE_NAME);
        $manager->persist($product2);


        $product3 = new Product();
        $product3->setName('Product 3');
        $product3->setPrice(00.22);
        $product3->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $product3->setCategory($this->getReference(CategoryFixtures::CATEGORY_2));
        $product3->setImageFile($this->getImageUploadedFileExample());
        $product3->setImageName(self::IMAGE_EXAMPLE_FILE_NAME);
        $manager->persist($product3);

        $product = new Product();
        $product->setName('Product 4');
        $product->setPrice(1.22);
        $product->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_3));
        $product->setImageFile($this->getImageUploadedFileExample());
        $product->setImageName(self::IMAGE_EXAMPLE_FILE_NAME);
        $manager->persist($product);

        $product = new Product();
        $product->setName('Product 5');
        $product->setPrice(42.00);
        $product->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_4));
        $product->setImageFile($this->getImageUploadedFileExample());
        $product->setImageName(self::IMAGE_EXAMPLE_FILE_NAME);
        $manager->persist($product);

        $product = new Product();
        $product->setName('Product 6');
        $product->setPrice(21);
        $product->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_5));
        $product->setImageFile($this->getImageUploadedFileExample());
        $product->setImageName(self::IMAGE_EXAMPLE_FILE_NAME);
        $manager->persist($product);

        $product = new Product();
        $product->setName('Product 7');
        $product->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.");
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_5));
        $product->setImageFile($this->getImageUploadedFileExample());
        $product->setImageName(self::IMAGE_EXAMPLE_FILE_NAME);
        $manager->persist($product);

        $manager->flush();

        $this->addReference(self::PRODUCT_1, $product1);
        $this->addReference(self::PRODUCT_2, $product2);
        $this->addReference(self::PRODUCT_3, $product3);
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }

    private function getImageUploadedFileExample(): UploadedFile
    {
        $sourceFilePath = __DIR__.self::IMAGE_EXAMPLE_FILE_PATH.self::IMAGE_EXAMPLE_FILE_NAME;
        $copyFilePath = __DIR__.self::IMAGE_EXAMPLE_FILE_PATH.self::IMAGE_EXAMPLE_COPY_FILE_NAME;

        // Copy image file to avoid moving the original one
        copy($sourceFilePath, $copyFilePath);

        return new UploadedFile(
            $copyFilePath,
            self::IMAGE_EXAMPLE_FILE_NAME,
            self::IMAGE_EXAMPLE_MIME_TYPE,
            null,
            true
        );
    }
}
