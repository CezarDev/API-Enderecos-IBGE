<?php

namespace Tests\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Response;
use Tests\TestCase;

class EnderecoControllerTests extends TestCase
{

    public function deveCadastrarEnderecoComSucesso()
    {

        $payload = [
            'logradouro' => $this->faker->logradouro,
            'numero'  => $this->faker->numero,
            'bairro'  => $this->faker->bairro,
            'cidade_id'      => $this->faker->cidade_id
        ];
        $this->json('post', 'api/endereco', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'logradouro',
                        'numero',
                        'bairro',
                        'email',
                        'cidade_id'
                    ]
                ]
            );
        $this->assertDatabaseHas('enderecos', $payload);
    }

    public function deveRetornarOsEnderecosNoBancoComSucesso()
    {

        $this->json('get', 'api/endereco')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'logradouro',
                            'numero',
                            'bairro',
                            'cidade_id'
                        ]
                    ]
                ]
            );
    }

    public function testendereco()
    {
        $endereco = Endereco::create(
            [
                'logradouro' => $this->faker->logradouro,
                'numero'  => $this->faker->numero,
                'bairro'  => $this->faker->bairro,
                'cidade_id'      => $this->faker->cidade_id
            ]
        );

        $this->json('get', "api/enderco/$endereco->id")
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'data' => [
                        'id'         => $endereco->id,
                        'logradouro' => $endereco->logradouro,
                        'numero'  => $endereco->numero,
                        'bairro'      => $endereco->bairro,
                        'cidade_id' => (string)$endereco->cidade_id
                    ]
                ]
            );
    }

    public function testUserIsDestroyed()
    {

        $enderecoSalvo =
            [
                'logradouro' => $this->faker->logradouro,
                'numero'  => $this->faker->numero,
                'bairro'  => $this->faker->bairro,
                'cidade_id'      => $this->faker->cidade_id
            ];
        $endereco = Endereco::create(
            $enderecoSalvo
        );

        $this->json('delete', "api/endereco/$endereco->id")
            ->assertNoContent();
        $this->assertDatabaseMissing('enderecos', $enderecoSalvo);
    }

    public function testUpdateUserReturnsCorrectData()
    {
        $endereco = Endereco::create(
            [
                'logradouro' => $this->faker->logradouro,
                'numero'  => $this->faker->numero,
                'bairro'  => $this->faker->bairro,
                'cidade_id'      => $this->faker->cidade_id
            ]
        );

        $payload = [
            'logradouro' => $this->faker->logradouro,
            'numero'  => $this->faker->numero,
            'bairro'  => $this->faker->bairro,
            'cidade_id'      => $this->faker->cidade_id
        ];

        $this->json('put', "api/endereco/$endereco->id", $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'data' => [
                        'id'         => $endereco->id,
                        'logradouro' => $this->faker->logradouro,
                        'numero'  => $this->faker->numero,
                        'bairro'  => $this->faker->bairro,
                        'cidade_id'      => $this->faker->cidade_id
                    ]
                ]
            );
    }
}
