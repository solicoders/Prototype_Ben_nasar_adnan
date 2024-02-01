<?php


namespace Tests\Feature\Comment;

use Tests\TestCase;
use App\Models\Image;
use App\Repository\ImageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImagesTest extends TestCase
{
    use DatabaseTransactions;


    protected $imageRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->imageRepository = app(ImageRepository::class);
    }

    // ======================================== get all the images ==============================

    public function test_Get_All_Images()
    {
        // Create test data
        $image1 = Image::create([
            
                "name" => "sandorai",
                "url" => "https/sandorai/sandorai",
                "reference" => "moo45",
                "presentation_id" => 1
    
       ]);
       $image2 = Image::create([
            
        "name" => "sandorai 2",
        "url" => "https/sandorai/sandorai2",
        "reference" => "moo2",
        "presentation_id" => 1

]);
$image3 = Image::create([
            
    "name" => "sandorai 3",
    "url" => "https/sandorai/sandorai",
    "reference" => "moo3",
    "presentation_id" => 1

]);
        

        // Call the getAllImages method with a search query
        $result = $this->imageRepository->getAllImages('sandorai');

        // Assert that the result is a paginated collection
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $result);

        // Assert that the paginated collection contains the correct items
        // $this->assertEquals(2, $result->count());
        $this->assertTrue($result->contains('name', 'sandorai'));
        $this->assertTrue($result->contains('name', 'sandorai 2'));
        $this->assertFalse($result->contains('name', 'sandorai 3'));
    }




    // ================================ create image =================================
    public function testCreateImage()
    {
        // Input data for the new image
        $inputData = [
        "name" => "image 22",
        "url" => "https/sandorai/image 22",
        "reference" => "image 22",
        "presentation_id" => 1
        ];

        // Call the create method
        $createdImage = $this->imageRepository->create($inputData);

        
        $this->assertInstanceOf(Image::class, $createdImage);

    
        $this->assertDatabaseHas('images', $inputData);

    }

    // ======================== edit function ========================

    public function testEditImages()
    {
        // Create a test image
        $image = Image::create([    
        "name" => "image 66",
        "url" => "https/sandorai/image 66",
        "reference" => "image 66",
        "presentation_id" => 1
    ]);

    
        $retrievedImage = $this->imageRepository->editImages($image->id);

       
        $this->assertInstanceOf(Image::class, $retrievedImage);

   
        $this->assertEquals('image 66', $retrievedImage->name);
    }

    // ======================== update function ========================

    public function testUpdateImages()
    {
        // Create a test image
        $image = Image::create([

            "name" => "image 77",
            "url" => "https/sandorai/image 77",
            "reference" => "image 77",
            "presentation_id" => 1
        ]);

        // Data to update the image
        $updateData = [


            "name" => "image 88",
            "url" => "https/sandorai/image 88",
            "reference" => "image 88",
            "presentation_id" => 1
        ];

        // Call the updateImages method
        $updatedImage = $this->imageRepository->updateImages($image->id, $updateData);

        // Assert that the updated image is an instance of Image model
        $this->assertInstanceOf(Image::class, $updatedImage);

        // Refresh the image model from the database
        $image->refresh();

        // Assert that the image has been updated in the database
        $this->assertEquals('image 88', $image->name);
    }

    // =============== delete function ===================
    public function testDeleteImages()
    {
        // Create a test image
        $image = Image::create([

            "name" => "image 123",
            "url" => "https/sandorai/image 123",
            "reference" => "image 123",
            "presentation_id" => 1
        ]);

        // Call the delete_images method
        $this->imageRepository->delete_images($image->id);

        // Assert that the image has been deleted from the database
        $this->assertDatabaseMissing('images', ['id' => $image->id]);
    }


}
