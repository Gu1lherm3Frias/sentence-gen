<?php

namespace App\Services;

use Carbon\Carbon;

class DateService
{
    /**
     * Converte dia da semana em português para número (1=segunda, 7=domingo)
     *
     * @param string|null $day
     * @return int|null
     */
    public static function dayOfWeekToNumber(?string $day): ?int
    {
        if (!$day) {
            return null;
        }

        // Normaliza: minúsculo, sem acentos, sem espaços extras, sem "-feira"
        $day = trim(mb_strtolower($day));
        $day = str_replace('-feira', '', $day);
        
        // Remove acentos manualmente
        $day = self::removeAccents($day);

        // Mapeamento dias da semana (sem "-feira" e sem acentos)
        $daysMap = [
            'segunda'   => 1,
            'seg'       => 1,
            'terca'     => 2,
            'ter'       => 2,
            'quarta'    => 3,
            'qua'       => 3,
            'quinta'    => 4,
            'qui'       => 4,
            'sexta'     => 5,
            'sex'       => 5,
            'sabado'    => 6,
            'sab'       => 6,
            'domingo'   => 7,
            'dom'       => 7,
        ];

        if (isset($daysMap[$day])) {
            return $daysMap[$day];
        }

        try {
            Carbon::setLocale('pt_BR');
            $carbon = Carbon::parse($day);
            
            if ($carbon) {
                return $carbon->dayOfWeekIso;
            }
        } catch (\Exception $e) {
        }

        return null;
    }

    /**
     * Remove acentos de uma string
     *
     * @param string $string
     * @return string
     */
    private static function removeAccents(string $string): string
    {
        $accents = [
            'á', 'à', 'â', 'ã', 'ä',
            'é', 'è', 'ê', 'ë',
            'í', 'ì', 'î', 'ï',
            'ó', 'ò', 'ô', 'õ', 'ö',
            'ú', 'ù', 'û', 'ü',
            'ç',
        ];
        
        $noAccents = [
            'a', 'a', 'a', 'a', 'a',
            'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u',
            'c',
        ];

        return str_replace($accents, $noAccents, $string);
    }

    public static function numberToDayOfWeek(?int $dayNumber, bool $abbreviated = false): ?string
    {
        if (!$dayNumber || $dayNumber < 1 || $dayNumber > 7) {
            return null;
        }

        $days = [
            1 => 'Segunda-feira',
            2 => 'Terça-feira',
            3 => 'Quarta-feira',
            4 => 'Quinta-feira',
            5 => 'Sexta-feira',
            6 => 'Sábado',
            7 => 'Domingo',
        ];

        $daysShort = [
            1 => 'seg',
            2 => 'ter',
            3 => 'qua',
            4 => 'qui',
            5 => 'sex',
            6 => 'sáb',
            7 => 'dom',
        ];

        return $abbreviated ? ($daysShort[$dayNumber] ?? null) : ($days[$dayNumber] ?? null);
    }


}