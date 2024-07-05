<?php

namespace Service;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Domain\Factory\LoanProposalFactory;
use PragmaGoTech\Interview\Domain\Service\FeeCalculator;
use PragmaGoTech\Interview\Domain\Strategy\Fee\FeeLinearInterpolationStrategy;
use PragmaGoTech\Interview\Infrastructure\Dictionary\TermMonthDictionary;
use PragmaGoTech\Interview\Infrastructure\Repository\FeeStructureProvider;
use PragmaGoTech\Interview\Infrastructure\Repository\FeeStructureRepository;
use PragmaGoTech\Interview\Shared\FeeStructureMap;
use PragmaGoTech\Interview\Shared\Loan;
use PragmaGoTech\Interview\Shared\LoanProposal;
use PragmaGoTech\Interview\Shared\Term;

class FeeCalculatorTest extends TestCase
{
    private FeeStructureProvider $feeStructureProviderMock;
    private LoanProposal $loanProposalMock;

    protected function setUp(): void
    {
        $this->feeStructureProviderMock = $this->getMockBuilder(FeeStructureProvider::class)
            ->setConstructorArgs([new FeeStructureMap()])
            ->onlyMethods(['getFeeStructureForMonths'])
            ->getMock();
            $this->loanProposalMock = $this->createMock(LoanProposal::class);
    }

    /**
     * @return array<array<int|float>>
     */
    public static function dataFor12Month(): array
    {
        return [
            [1000, 50],
            [1000.00, 50],
            [1000.01, 55],
            [1150, 55],
            [1232.65, 60],
            [2465.21, 95],
            [3214.5, 100],
            [4587.23, 110],
            [5555.55, 115],
            [6897.76, 140],
            [7654.23, 155],
            [12542.58, 255],
            [17236.64, 345],
            [20000, 400],
            [19123.19, 385],
            [19999.99, 400],
        ];
    }

    private function mockProviderDataFor12Month(): void
    {
        $this->feeStructureProviderMock->method('getFeeStructureForMonths')
            ->withAnyParameters()
            ->willReturn([
                1100 => 55,
                1200 => 55,
                3000 => 90,
                4000 => 115,
                5000 => 100,
                7000 => 140,
                2000 => 90,
                '2465.22' => 95,
                1000 => 50,
                12000 => 240,
                8000 => 160,
                6000 => 120,
                10000 => 200,
                19000 => 380,
                9000 => 180,
                14000 => 280,
                13000 => 260,
                '3214.50' => 100,
                '3214.00' => 95,
                '3415' => 95,
                15000 => 300,
                11000 => 220,
                17000 => 340,
                18000 => 360,
                20000 => 400,
                16000 => 320,
            ]);
    }

    #[DataProvider('dataFor12Month')]
    public function testCalculateFor12Month(float $loanAmount, int $expectedFeeAmount): void
    {
        $this->mockProviderDataFor12Month();

        $feeCalculator = new FeeCalculator(
            new FeeStructureRepository($this->feeStructureProviderMock),
            new FeeLinearInterpolationStrategy()
        );
        $this->loanProposalMock->method('getLoan')
            ->willReturn(new Loan($loanAmount));
        $this->loanProposalMock->method('getTerm')
            ->willReturn(new Term(TermMonthDictionary::MONTHS_12));

        $fee = $feeCalculator->calculate($this->loanProposalMock);
        $this->assertEquals($expectedFeeAmount, $fee->getAmount());
    }

    #[DataProvider('dataFor12Month')]
    public function testIntegrationCalculateFor12Month(float $loanAmount, int $expectedFeeAmount): void
    {
        $this->mockProviderDataFor12Month();

        $feeCalculator = new FeeCalculator(
            new FeeStructureRepository($this->feeStructureProviderMock),
            new FeeLinearInterpolationStrategy()
        );

        $fee = $feeCalculator->calculate(LoanProposalFactory::create(12, $loanAmount));
        $this->assertEquals($expectedFeeAmount, $fee->getAmount());
    }

    /**
     * @return array<array<int|float>>
     */
    public static function dataFor24Month(): array
    {
        return [
            [1000.00, 70],
            [1000.01, 75],
            [1232.65, 80],
            [2465.21, 110],
            [3214.5, 130],
            [4587.23, 185],
            [5555.55, 225],
            [6897.76, 280],
            [7654.23, 310],
            [12542.58, 505],
            [17236.64, 690],
            [19123.19, 765],
            [19999.99, 800],
            [20000.00, 800],
        ];
    }
    private function mockProviderDataFor24Month(): void
    {
        $this->feeStructureProviderMock->method('getFeeStructureForMonths')
            ->withAnyParameters()
            ->willReturn([
                2000 => 100,
                8000 => 320,
                4000 => 160,
                3000 => 120,
                6000 => 240,
                5000 => 200,
                12000 => 480,
                20000 => 800,
                7000 => 280,
                10000 => 400,
                9000 => 360,
                1000 => 70,
                13000 => 520,
                18000 => 720,
                19000 => 760,
                11000 => 440,
                16000 => 640,
                14000 => 560,
                15000 => 600,
                17000 => 680,
            ]);
    }

    #[DataProvider('dataFor24Month')]
    public function testCalculateFor24Month(float $loanAmount, int $expectedFeeAmount): void
    {
        $this->mockProviderDataFor24Month();

        $feeCalculator = new FeeCalculator(
            new FeeStructureRepository($this->feeStructureProviderMock),
            new FeeLinearInterpolationStrategy()
        );

        $this->loanProposalMock->method('getLoan')
            ->willReturn(new Loan($loanAmount));
        $this->loanProposalMock->method('getTerm')
            ->willReturn(new Term(TermMonthDictionary::MONTHS_24));

        $fee = $feeCalculator->calculate($this->loanProposalMock);
        $this->assertEquals($expectedFeeAmount, $fee->getAmount());
    }

    #[DataProvider('dataFor24Month')]
    public function testIntegrationCalculateFor24Month(float $loanAmount, int $expectedFeeAmount): void
    {
        $this->mockProviderDataFor24Month();

        $feeCalculator = new FeeCalculator(
            new FeeStructureRepository($this->feeStructureProviderMock),
            new FeeLinearInterpolationStrategy()
        );

        $fee = $feeCalculator->calculate(LoanProposalFactory::create(24, $loanAmount));
        $this->assertEquals($expectedFeeAmount, $fee->getAmount());
    }
}