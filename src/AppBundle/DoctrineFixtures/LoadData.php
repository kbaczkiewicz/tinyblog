<?php

namespace AppBundle\DoctrineFixtures;

use AppBundle\Entity\Category;
use AppBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Test Category');
        $category->setSlug('test-category');

        $post = new Post();
        $title = 'Lorem Ipsum';
        $author = 'Gal Anonim';

        for ($a = 0; $a < 10; $a++) {
            $post = new Post();
            $post->setAuthor($author);
            $post->setCreatedAt(new \DateTime('now + ' . rand(1, 3) . ' years'));
            $post->setTitle($title);
            $post->setPost($this->getPostContents()[$a]);
            $post->setCategory($category);
            $category->addPost($post);
            $manager->persist($post);
        }

        $manager->persist($category);
        $manager->flush();
    }

    private function getPostContents()
    {

        return [
            'Aut provident quis atque omnis deleniti ducimus qui nam. Deserunt tempora odit non voluptates officia. Quo fugit dolor impedit. Perspiciatis labore sint ea. Vitae culpa iure cumque corrupti enim repudiandae. Accusantium et optio nam provident est et.',
            'Autem eos consequatur ut et amet. Esse vitae doloribus repellendus modi cumque et. Sint et commodi ut ullam eligendi voluptatem natus. Laudantium earum quam nostrum ut enim.',
            'Animi odio eum ducimus doloremque consequatur possimus eos deleniti. Rerum voluptas vel rerum perspiciatis dicta dicta dolor. Dolorem perspiciatis laudantium eos dolorem omnis impedit non et.',
            'Repudiandae est perferendis provident aut. Cupiditate aspernatur ut pariatur. Qui quisquam reprehenderit perferendis cum qui. Vero est voluptas et voluptatem repellat. Rerum ipsum autem aliquid sequi dolore eos. Ut molestiae aut aut.',
            'Rerum voluptates suscipit sunt nulla repellendus soluta odit. Non ut eum corporis nobis quia facilis deleniti. Repellendus facere velit aut earum harum optio. Non delectus dolore et et incidunt unde. Quos iste excepturi dicta. Et ipsum nulla voluptates dolor tempore quibusdam.',
            'Sed nobis fuga dolores dolor. Soluta dolorem officia ratione. Vitae nulla eveniet veniam natus dolorem perspiciatis expedita. Doloremque deleniti sed expedita ducimus aliquam consequatur tenetur voluptatum.',
            'Nihil neque nobis magnam ut facilis asperiores neque. Similique ut sapiente magnam accusantium sed totam voluptate. Rerum repudiandae corrupti nostrum repellat qui hic facilis. Incidunt aut sequi est excepturi aut eos.',
            'Suscipit ut qui explicabo. Quia non cum qui ad laborum et voluptate eos. Eligendi laborum laboriosam dolorem tempore ut tenetur et. Doloribus aliquid aliquid expedita. In fugiat nulla iusto neque hic autem.',
            'Recusandae nihil dolores quidem similique dolorum rerum nostrum. Dolores nisi nihil voluptatem debitis a delectus. Temporibus mollitia labore omnis perferendis.',
            'Enim fuga et natus in laborum quo. Fugiat atque est id. Non harum nisi et sit debitis beatae nihil.',
        ];
    }
}